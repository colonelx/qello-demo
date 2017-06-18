<?php

namespace QKidsDemo\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use QKidsDemo\Exception\QelloApiErrorException;
use QKidsDemo\Validation\UserRegistrationValidator;

/**
 * Class RegistrationController
 * @package QKidsDemo\Controller
 */
class RegistrationController extends BaseController
{
    /**
     * @param Request $request
     * @param Response $response
     * @method GET
     */
    public function index(Request $request, Response $response)
    {
        return $this->renderView($response, 'registration.twig');
    }

    /**
     * Handles registration and redirects to home
     * @param Request $request
     * @param Response $response
     * @return void|static
     * @method POST
     */
    public function send(Request $request, Response $response)
    {
        $validator = new UserRegistrationValidator();
        $inputs = $request->getParsedBody();
        $isValid = $validator->assert($inputs);

        try {
            $user_api = $this->api->users();
            $token = $user_api->getToken(
                $inputs['email'],
                $inputs['password'],
                $inputs['first_name'],
                $inputs['last_name']
            );
        } catch (QelloApiErrorException $ex) {
            $isValid = false;
            $validator->addApiError($ex->getMessage());
        }

        if (!$isValid) {
            return $this->renderView($response, 'registration.twig', [
                'errors' => $validator->errors(),
                'inputs' => $inputs
            ]);
        }

        $this->container->get('session_manager')->set('token', $token);

        return $response->withRedirect('/', 302);
    }
}
