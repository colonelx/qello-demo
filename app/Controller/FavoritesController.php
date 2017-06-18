<?php

namespace QKidsDemo\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class FavoritesController
 * @package QKidsDemo\Controller
 */
class FavoritesController extends BaseController
{
    /**
     * Add Asset to Favorites
     * @param Request $request
     * @param Response $response
     * @param $args Stores router url arguments, currently only $id is defined
     * @return static
     * @method GET
     */
    public function add(Request $request, Response $response, $args)
    {
        $this->api->collection()->addToFavorites($args['id']);

        return $response->withRedirect('/app/assets', 302);
    }

    /**
     * Remoe Asset From Favorites
     * @param Request $request
     * @param Response $response
     * @param $args Stires router url arguments, currently only $id is defined
     * @return static
     * @method GET
     */
    public function remove(Request $request, Response $response, $args)
    {
        $this->api->collection()->removeFromFavorites($args['id']);

        return $response->withRedirect('/app/assets', 302);
    }
}