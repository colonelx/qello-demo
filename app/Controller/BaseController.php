<?php

namespace QKidsDemo\Controller;

use Interop\Container\ContainerInterface;
use QKidsDemo\Library\QelloApi;
use QKidsDemo\Model\Device;

/**
 * Class BaseController
 * @package QKidsDemo\Controller
 */
abstract class BaseController
{
    protected $container;
    protected $api;

    /**
     * BaseController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->initApi();
    }

    /**
     * Renders a view using twig
     * @param $resposne
     * @param $view
     * @param null $data
     */
    protected function renderView($resposne, $view, $data = null)
    {
        $isLogged = !empty($this->container->session_manager->get('token'));

        if (is_array($data)) {
            $viewData = array_merge($data, ['is_logged' => $isLogged]);
        } else {
            $viewData = ['is_logged' => $isLogged];
        }

        $this->container->view->render($resposne, $view, $viewData);
    }

    /**
     * Inits an API instance to be used in children
     */
    protected function initApi()
    {
        $this->api = new QelloApi(
            $this->container->config['qkids_api_uri'],
            $this->container->session_manager->get('token'),
            new Device(),
            '1.0.0'
        );
    }
}
