<?php

/**
 * Global helper functions
 */

function e(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function url(string $path = '/'): string
{
    return SITE_URL . $path;
}

function asset(string $path): string
{
    return SITE_URL . '/public/' . ltrim($path, '/');
}

function view(string $viewPath, array $data = [], string $layout = 'main'): void
{
    extract($data);
    ob_start();
    require VIEWS_PATH . '/' . $viewPath . '.php';
    $content = ob_get_clean();
    require VIEWS_PATH . '/layouts/' . $layout . '.php';
}

function partial(string $name, array $data = []): void
{
    extract($data);
    require VIEWS_PATH . '/partials/' . $name . '.php';
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function getFlashes(): array
{
    $flashes = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $flashes;
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function currentUserId(): ?int
{
    return $_SESSION['user_id'] ?? null;
}

function currentUser(): ?array
{
    if (!isLoggedIn()) return null;
    static $user = null;
    if ($user === null) {
        $userModel = new User();
        $user = $userModel->findById(currentUserId());
    }
    return $user;
}

function isPro(): bool
{
    $user = currentUser();
    return $user && $user['plan'] === 'pro' && ($user['plan_expires_at'] === null || $user['plan_expires_at'] > date('Y-m-d H:i:s'));
}

function jsonResponse(array $data, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function isAjax(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function input(string $key, $default = null)
{
    return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
}

function query(string $key, $default = null)
{
    return isset($_GET[$key]) ? trim($_GET[$key]) : $default;
}

function formatSize(int $bytes): string
{
    if ($bytes >= 1048576) {
        return round($bytes / 1048576, 2) . ' Mo';
    }
    if ($bytes >= 1024) {
        return round($bytes / 1024, 1) . ' Ko';
    }
    return $bytes . ' o';
}

function formatPercent(int $original, int $compressed): string
{
    if ($original === 0) return '0%';
    return round((1 - $compressed / $original) * 100) . '%';
}

function slugify(string $text): string
{
    $text = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function generateFilename(string $extension): string
{
    return bin2hex(random_bytes(16)) . '.' . $extension;
}

function cleanOldUploads(int $maxAge = 3600): void
{
    $dir = UPLOADS_PATH;
    foreach (glob($dir . '/*') as $file) {
        if (is_file($file) && time() - filemtime($file) > $maxAge) {
            unlink($file);
        }
    }
}
