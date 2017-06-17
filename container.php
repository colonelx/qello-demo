<?php

require 'vendor/autoload.php';
use Slim\Container;

$dotEnv = new \Dotenv\Dotenv(realpath(__DIR__));
$dotEnv->load();
$config = require 'app/config/config.php';
$app = require 'app/config/router.php';
$views = require 'app/config/views.php';

$container = new Container(array_merge(
    ['config' => $config],
    ['app' => $app],
    ['view' => $views],
    ['session_manager' => new QKidsDemo\Library\SessionManager()]
));

return $container;