<?php

/** @noinspection PhpUndefinedVariableInspection */
$container = $app->getContainer();

$container['session_manager'] = function ($container) {
    return new \QKidsDemo\Service\SessionManager();
};

$container['view'] = function ($container) {

    $view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
        'cache' => false
    ]);

    /** @noinspection PhpUndefinedMethodInspection */
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');

    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};
