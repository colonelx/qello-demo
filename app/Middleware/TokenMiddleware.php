<?php

namespace QKidsDemo\Middleware;

use QKidsDemo\Library\SessionManager;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class TokenMiddleware
 * Responsible for handing the token. If token exists proceed with request
 * If not redirect to registration page.
 * @package QKidsDemo\Middleware
 */
class TokenMiddleware
{
    protected $sessionManager;

    /**
     * TokenMiddleware constructor.
     * @param SessionManager $sessionManager
     */
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response/callable
     */
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
