<?php

namespace QKidsDemo\Library\QelloApi;


use QKidsDemo\Library\QelloApi;
use QKidsDemo\Model\Asset;

class Content extends AbstractApi
{
    protected $classification;
    protected $type;
    private $favorites;

    public function __construct(QelloApi $apiInstance, $args)
    {
        parent::__construct($apiInstance);

        $this->classification = $args[0];
        $this->type = $args[1];
    }

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

    public function getAssetsCount($offset = 0, $limit = 0)
    {
            return $this->assetsCall(0, 0)->data->total;
    }

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

    private function isAssetInFavorites($asset)
    {

        foreach($this->favorites as $favAsset) {
            if($favAsset->id == $asset->id) return true;
        }

        return false;
    }
}