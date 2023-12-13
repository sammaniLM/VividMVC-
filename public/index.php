<?php

use System\Core\Application;
require_once '../vendor/autoload.php';

define('BASE_PATH', dirname(__DIR__). '/');

spl_autoload_register(function ($class) {
    $file = BASE_PATH . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$app = new Application();
$app->run();