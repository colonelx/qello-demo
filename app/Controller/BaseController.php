<?php

namespace QKidsDemo\Controller;

use Interop\Container\ContainerInterface;
use QKidsDemo\Library\QelloApi;
use QKidsDemo\Model\Device;

abstract class BaseController
{
    protected $container;
    protected $api;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->initApi();
    }

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
