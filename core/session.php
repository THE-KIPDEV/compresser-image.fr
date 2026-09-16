<?php
/**
 * Sessions PHP en base.
 *
 * 🚨 Elles vivaient en fichiers DANS le conteneur, recréé à chaque déploiement :
 *    chaque mise en production déconnectait tous les comptes, et un visiteur sans
 *    compte perdait son brouillon ou son achat en cours quand le site les rattache
 *    à son `session_id`. Audit du parc le 15/09/2026 : 29 sites concernés.
 *
 * Connexion PDO séparée, volontairement : ce fichier est chargé AVANT le reste du
 * socle, et `Database::getInstance()` fait `die()` quand la base ne répond pas —
 * une page qui n'a pas besoin de la base ne doit pas tomber pour une session.
 *
 * Verrou MySQL (GET_LOCK) pendant la requête, comme le verrou de fichier du
 * gestionnaire par défaut : sans lui, deux requêtes simultanées de la même session
 * s'écraseraient. Écriture seulement si les données ont changé.
 *
 * Repli silencieux sur les fichiers si la base ne répond pas : mieux vaut une
 * session perdue qu'un site en 503.
 */
class SessionEnBase implements SessionHandlerInterface, SessionUpdateTimestampHandlerInterface
{
    private const RAFRAICHIR_APRES = 300;

    private PDO $db;
    private int $duree;
    private string $empreinteLue = '';
    private ?string $verrou = null;

    public function __construct(PDO $db, int $duree) {
        $this->db = $db;
        $this->duree = $duree;
    }

    public function open(string $path, string $name): bool {
        return true;
    }

    public function close(): bool {
        if ($this->verrou !== null) {
            try { $this->db->prepare('SELECT RELEASE_LOCK(?)')->execute([$this->verrou]); } catch (Throwable $e) {}
            $this->verrou = null;
        }
        return true;
    }

    public function read(string $id): string|false {
        // Nom de verrou borné à 64 caractères par MySQL.
        $this->verrou = 'sess_' . substr(hash('sha256', $id), 0, 48);
        try {
            $this->db->prepare('SELECT GET_LOCK(?, 5)')->execute([$this->verrou]);
        } catch (Throwable $e) {
            $this->verrou = null;
        }
        try {
            $st = $this->db->prepare('SELECT data FROM sessions WHERE id = ? AND updated_at > ?');
            $st->execute([$id, time() - $this->duree]);
            $data = (string) ($st->fetchColumn() ?: '');
        } catch (Throwable $e) {
            $data = '';
        }
        $this->empreinteLue = md5($data);
        return $data;
    }

    public function write(string $id, string $data): bool {
        if (md5($data) === $this->empreinteLue) {
            return $this->updateTimestamp($id, $data);
        }
        try {
            $this->db->prepare(
                'INSERT INTO sessions (id, data, updated_at) VALUES (?, ?, ?)
                 ON DUPLICATE KEY UPDATE data = VALUES(data), updated_at = VALUES(updated_at)'
            )->execute([$id, $data, time()]);
        } catch (Throwable $e) {
            return false;
        }
        return true;
    }

    public function destroy(string $id): bool {
        try { $this->db->prepare('DELETE FROM sessions WHERE id = ?')->execute([$id]); } catch (Throwable $e) {}
        return true;
    }

    public function gc(int $max_lifetime): int|false {
        try {
            $st = $this->db->prepare('DELETE FROM sessions WHERE updated_at < ?');
            $st->execute([time() - $max_lifetime]);
            return $st->rowCount();
        } catch (Throwable $e) {
            return 0;
        }
    }

    public function validateId(string $id): bool {
        return true;
    }

    public function updateTimestamp(string $id, string $data): bool {
        if ($data === '') return true;   // session vide : rien à garder
        try {
            $this->db->prepare('UPDATE sessions SET updated_at = ? WHERE id = ? AND updated_at < ?')
                ->execute([time(), $id, time() - self::RAFRAICHIR_APRES]);
        } catch (Throwable $e) {}
        return true;
    }
}

/**
 * Branche les sessions en base quand c'est possible, sinon laisse les fichiers.
 * À appeler juste avant `session_start()`.
 */
function session_en_base(): void {
    $duree = defined('SESSION_LIFETIME') ? (int) SESSION_LIFETIME : 86400 * 30;
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        ini_set('session.gc_maxlifetime', (string) $duree);
        // Le cookie expirait à la fermeture du navigateur alors que la session est
        // prévue pour bien plus long : un invité perdait son brouillon en rouvrant.
        ini_set('session.cookie_lifetime', (string) $duree);
    }
    foreach (['DB_HOST', 'DB_NAME', 'DB_USER'] as $constante) {
        if (!defined($constante)) return;
    }
    $hote = (string) DB_HOST;
    if ($hote === '' || str_contains($hote, '${')) return;

    try {
        $db = new PDO(
            'mysql:host=' . $hote . ';dbname=' . DB_NAME . ';charset=' . (defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4'),
            DB_USER,
            defined('DB_PASS') ? DB_PASS : '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 3, PDO::ATTR_EMULATE_PREPARES => false]
        );
        try {
            $db->query('SELECT 1 FROM sessions LIMIT 0');
        } catch (Throwable $e) {
            // Première mise en service : la table se crée toute seule.
            $db->exec('CREATE TABLE IF NOT EXISTS sessions (
                id VARCHAR(128) NOT NULL PRIMARY KEY,
                data MEDIUMBLOB NOT NULL,
                updated_at INT UNSIGNED NOT NULL,
                KEY idx_updated (updated_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin');
        }
        session_set_save_handler(new SessionEnBase($db, $duree), true);
    } catch (Throwable $e) {
        // Base injoignable : on garde les sessions en fichiers.
    }
}
