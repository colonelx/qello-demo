<?php

require __DIR__ . '/../vendor/autoload.php';
// Load config
$dotEnv = new \Dotenv\Dotenv(realpath(__DIR__ . '/../'));
$dotEnv->load();
require 'config/config.php';

if (!isset($config)) {
    throw new HttpRuntimeException("Configuration not found");
} else {
    $app = new \Slim\App($config);
}
