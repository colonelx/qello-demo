<?php

$app->get('/', function ($request, $response, $args) {
    return $response->withRedirect('/app/');
});

/** @noinspection PhpUndefinedVariableInspection */
$app->get('/register', \QKidsDemo\Controller\RegistrationController::class . ':index')->setName('register')
    ->add(new \QKidsDemo\Middleware\SessionMiddleware());

$app->post('/register', \QKidsDemo\Controller\RegistrationController::class . ':send')
    ->add(new \QKidsDemo\Middleware\SessionMiddleware());
$container = $app->getContainer();

$app->group('/app', function() use ($app) {

    /** @noinspection PhpUndefinedVariableInspection */
    $app->get('[/]', \QKidsDemo\Controller\HomeController::class . ':index')
        ->setName('home');

    /** @noinspection PhpUndefinedVariableInspection */
    $app->get('/assets[/{page}]', \QKidsDemo\Controller\AssetsController::class . ':index')
        ->setName('assets');

    /** @noinspection PhpUndefinedVariableInspection */
    $app->get('/favorites/add/{id}', \QKidsDemo\Controller\FavoritesController::class . ":add")
        ->setName('favorites_add');

    $app->get('/favorites/remove/{id}', \QKidsDemo\Controller\FavoritesController::class . ":remove")
        ->setName('favorites_delete');

})->add(new \QKidsDemo\Middleware\TokenMiddleware($container->get('session_manager')))
    ->add(new \QKidsDemo\Middleware\SessionMiddleware());
