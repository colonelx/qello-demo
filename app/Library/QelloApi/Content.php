<?php

namespace QKidsDemo\Library\QelloApi;


use QKidsDemo\Library\QelloApi;
use QKidsDemo\Model\Asset;

/**
 * Class Content
 * Content relate calls
 * @package QKidsDemo\Library\QelloApi
 */
class Content extends AbstractApi
{
    protected $classification;
    protected $type;
    private $favorites;

    /**
     * Content constructor.
     * @param QelloApi $apiInstance
     * @param $args
     */
    public function __construct(QelloApi $apiInstance, $args)
    {
        parent::__construct($apiInstance);

        $this->classification = $args[0];
        $this->type = $args[1];
    }

    /**
     * Fetch a list of assets from the API and make another call to fetch
     * the favorites then create an array of Asset objects
     * @param int $offset
     * @param int $limit
     * @return array<Asset>
     */
    public function getAssets($offset = 0, $limit = 0)
    {
        $this->favorites = $this->assetsCall(0, 0, true)->data->assets;

        $assets = $this->assetsCall($offset, $limit)->data->assets;

        $assetObjects = [];

        foreach($assets as $asset)
        {
            $isFavorite = $this->isAssetInFavorites($asset);

            $assetObjects[] = new Asset($asset->id, $asset->meta->title, $asset->thumbs, $isFavorite);
        }

        return $assetObjects;
    }

    /**
     * Make a call to fetch the total number of assets with the given criteria
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function getAssetsCount($offset = 0, $limit = 0)
    {
            return $this->assetsCall(0, 0)->data->total;
    }

    /**
     * Make a API call to fetch assets
     * @param int $offset
     * @param int $limit
     * @param bool $favoritesOnly
     * @return Object
     */
    public function assetsCall($offset = 0, $limit = 0, $favoritesOnly = false)
    {
        $params = [
            'classification' => $this->classification,
            'type' => $this->type,
            'offset' => $offset,
            'limit' => $limit,
            'token' => $this->apiInstance->getToken()
        ];

        if ($favoritesOnly) {
            $params['collection_type'] = 'Favorites';
        }

        return $this->get('content', $params);
    }

    /**
     * Check if an asset is in favorites
     * @param $asset
     * @return bool
     */
    private function isAssetInFavorites($asset)
    {

        foreach($this->favorites as $favAsset) {
            if($favAsset->id == $asset->id) return true;
        }

        return false;
    }
}