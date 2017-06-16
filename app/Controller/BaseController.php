<?php

namespace QKidsDemo\Controller;

use Interop\Container\ContainerInterface;

class BaseController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function renderView($resposne, $view)
    {
        $this->container->view->render($resposne, $view);
    }
}
