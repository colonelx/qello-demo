<?php

namespace QKidsDemo\Middleware;

use QKidsDemo\Library\SessionManager;
use Slim\Http\Request;
use Slim\Http\Response;

class TokenMiddleware
{
    protected $sessionManager;
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $token = $this->sessionManager->get('token');
        if (!is_null($token)) {
            return $next($request, $response);
        }
        /** @noinspection PhpUndefinedMethodInspection */
        return $response->withRedirect('/register', 302);
    }
}
