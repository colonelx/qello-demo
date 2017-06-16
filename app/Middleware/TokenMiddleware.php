<?php

namespace QKidsDemo\Middleware;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use QKidsDemo\Service\SessionManager;

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
