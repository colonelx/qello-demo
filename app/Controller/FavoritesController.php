<?php

namespace QKidsDemo\Controller;


use Slim\Http\Request;
use Slim\Http\Response;

class FavoritesController extends BaseController
{
    public function add(Request $request, Response $response, $args)
    {
        $this->api->collection()->addToFavorites($args['id']);

        return $response->withRedirect('/app/assets', 302);
    }

    public function remove(Request $request, Response $response, $args)
    {
        $this->api->collection()->removeFromFavorites($args['id']);

        return $response->withRedirect('/app/assets', 302);
    }
}