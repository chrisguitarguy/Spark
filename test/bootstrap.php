<?php

$wp_test_dir = getenv('WP_TESTS_DIR') ?: false;

if (!$wp_test_dir) {
    throw new \Exception('Could not locate WP_TESTS_DIR');
}

require_once $wp_test_dir . '/includes/bootstrap.php';

require_once __DIR__ . '/../src/Autoloader.php';
require_once __DIR__ . '/../lib/Pimple.php';

$loader = new \Spark\Autoloader();
$loader
    ->addNamespace('Spark', __DIR__ . '/../src')
    ->register();
