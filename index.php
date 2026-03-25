<?php

/**
 * compresser-image.fr — Front Controller
 */

require_once __DIR__ . '/core/bootstrap.php';

$routes = require CONFIG_PATH . '/routes.php';

dispatch($routes);
