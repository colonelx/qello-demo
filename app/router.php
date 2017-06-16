<?php

$app->get('/', function ($request, $response, $args) {
    return $response->withRedirect('/app/');
});

/** @noinspection PhpUndefinedVariableInspection */
$app->get('/register', \QKidsDemo\Controller\RegistrationController::class . ':index')->setName('register');

$container = $app->getContainer();

$app->group('/app', function() use ($app) {

    /** @noinspection PhpUndefinedVariableInspection */
    $app->get('/', \QKidsDemo\Controller\HomeController::class . ':index')
        ->setName('home');

    /** @noinspection PhpUndefinedVariableInspection */
    $app->get('/assets', \QKidsDemo\Controller\AssetsController::class)
        ->setName('assets');

    /** @noinspection PhpUndefinedVariableInspection */
    $app->get('/favorites', \QKidsDemo\Controller\FavoritesController::class)
        ->setName('favorites');
})->add(new \QKidsDemo\Middleware\SessionMiddleware())
    ->add(new \QKidsDemo\Middleware\TokenMiddleware($container->get('session_manager')));
