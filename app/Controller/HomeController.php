<?php

namespace QKidsDemo\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends BaseController
{
    public function index(Request $request, Response $response)
    {
        return $this->renderView($response, 'home.twig');
    }
}
