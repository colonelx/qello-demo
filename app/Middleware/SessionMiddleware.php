<?php

namespace QKidsDemo\Middleware;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class SessionMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $this->startSession();
        return $next($request, $response);
    }

    protected function startSession()
    {
        session_name('qkids_session');
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }
}
