<?php

/**
 * Bootstrap — Load config, core modules, models
 */

require_once __DIR__ . '/../config/config.php';

// Error reporting
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Timezone
date_default_timezone_set('Europe/Paris');

// Session
if (session_status() === PHP_SESSION_NONE) {
    $embeddedTool = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '', '/') === '/embed/compresseur';
    session_set_cookie_params([
        'lifetime' => SESSION_LIFETIME,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $embeddedTool || !DEBUG,
        'httponly'  => true,
        'samesite'  => $embeddedTool ? 'None' : 'Lax',
    ]);
    // Sessions en base : elles survivent au déploiement (core/session.php).
    require_once __DIR__ . '/session.php';
    session_en_base();
    session_start();
    if ($embeddedTool) {
        // PHP 8.3 has no Partitioned option. Keep the essential iframe session
        // isolated by embedding site, without allowing cross-site tracking.
        header('Set-Cookie: ' . rawurlencode(session_name()) . '=' . rawurlencode(session_id())
            . '; Max-Age=' . SESSION_LIFETIME . '; Path=/; Secure; HttpOnly; SameSite=None; Partitioned', true);
    }
}

// Core modules
require_once CORE_PATH . '/database.php';
require_once CORE_PATH . '/helpers.php';
require_once CORE_PATH . '/csrf.php';
require_once CORE_PATH . '/auth.php';
require_once CORE_PATH . '/quota.php';
require_once CORE_PATH . '/router.php';

// Models
require_once MODELS_PATH . '/User.php';
require_once MODELS_PATH . '/Compression.php';
