<?php

namespace QKidsDemo\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController
 * @package QKidsDemo\Controller
 */
class HomeController extends BaseController
{
    /**
     * @param Request $request
     * @param Response $response
     * @method GET
     */
    public function index(Request $request, Response $response)
    {
        return $this->renderView($response, 'home.twig');
    }
}
