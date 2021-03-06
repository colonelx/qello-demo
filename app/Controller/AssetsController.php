<?php

namespace QKidsDemo\Controller;

use QKidsDemo\Library\Paginator;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AssetsController
 * @package QKidsDemo\Controller
 */
class AssetsController extends BaseController
{
    const CLASSIFICATION_EPISODE = 'Episode';
    const TYPE_VIDEO = 'Video';

    /**
     * @param Request $request
     * @param Response $response
     * @param $args Stores router url argumetns. Currently only page is defined
     * @method GET
     */
    public function index(Request $request, Response $response, $args)
    {
        $page = (isset($args['page'])) ? $args['page'] : 1;

        $total = $this->api->content(self::CLASSIFICATION_EPISODE, self::TYPE_VIDEO)->getAssetsCount();

        $perPage = $this->container->config['assets_per_page'];

        $paginator = new Paginator($page, $total, $perPage);

        $assets = $this->api->content(self::CLASSIFICATION_EPISODE, self::TYPE_VIDEO)->getAssets(
            $paginator->getRequestOffset(),
            $perPage
        );

        return $this->renderView($response, 'assets.twig',
            ['assets' => $assets, 'links' => $paginator->getPaginationLinks()]);
    }

}