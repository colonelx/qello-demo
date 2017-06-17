<?php

use Slim\Container;

$view_container = function (Container $c) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../../templates', [
        'cache' => false
    ]);

    /** @noinspection PhpUndefinedMethodInspection */
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');

    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

return $view_container;
