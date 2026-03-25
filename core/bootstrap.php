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
    session_set_cookie_params([
        'lifetime' => SESSION_LIFETIME,
        'path'     => '/',
        'domain'   => '',
        'secure'   => !DEBUG,
        'httponly'  => true,
        'samesite'  => 'Lax',
    ]);
    session_start();
}

// Core modules
require_once CORE_PATH . '/database.php';
require_once CORE_PATH . '/helpers.php';
require_once CORE_PATH . '/csrf.php';
require_once CORE_PATH . '/auth.php';
require_once CORE_PATH . '/router.php';

// Models
require_once MODELS_PATH . '/User.php';
require_once MODELS_PATH . '/Compression.php';
