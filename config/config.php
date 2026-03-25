<?php

/**
 * Configuration
 */

// Paths
define('ROOT_PATH',        __DIR__ . '/..');
define('CONFIG_PATH',      __DIR__);
define('CORE_PATH',        ROOT_PATH . '/core');
define('CONTROLLERS_PATH', ROOT_PATH . '/controllers');
define('MODELS_PATH',      ROOT_PATH . '/models');
define('VIEWS_PATH',       ROOT_PATH . '/views');
define('PUBLIC_PATH',      ROOT_PATH . '/public');
define('UPLOADS_PATH',     ROOT_PATH . '/uploads');

// Site
define('SITE_NAME',   'Compresser Image');
define('SITE_DOMAIN', getenv('SITE_DOMAIN') ?: 'compresser-image.fr');
define('SITE_URL',    getenv('SITE_URL') ?: 'https://compresser-image.fr');
define('SITE_DESC',   'Compressez vos images gratuitement en ligne. Réduisez la taille de vos fichiers PNG, JPEG et WebP sans perte de qualité visible. Slider avant/après pour comparer.');

// Database
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'compresser_image');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Stripe
define('STRIPE_PUBLIC_KEY',   getenv('STRIPE_PUBLIC_KEY') ?: '');
define('STRIPE_SECRET_KEY',   getenv('STRIPE_SECRET_KEY') ?: '');
define('STRIPE_WEBHOOK_SECRET', getenv('STRIPE_WEBHOOK_SECRET') ?: '');
define('STRIPE_PRICE_PRO_MONTHLY', getenv('STRIPE_PRICE_PRO_MONTHLY') ?: '');

// Limits
define('FREE_MAX_FILE_SIZE',   10 * 1024 * 1024);  // 10 MB
define('PRO_MAX_FILE_SIZE',    50 * 1024 * 1024);   // 50 MB
define('FREE_MAX_BATCH',       10);
define('PRO_MAX_BATCH',        100);
define('FREE_DAILY_LIMIT',     50);

// Session
define('SESSION_LIFETIME', 86400 * 30); // 30 days

// Debug
define('DEBUG', getenv('APP_DEBUG') === 'true');
