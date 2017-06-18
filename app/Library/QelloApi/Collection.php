<?php

namespace QKidsDemo\Library\QelloApi;

/**
 * Class Collection. Collection related API calls
 * @package QKidsDemo\Library\QelloApi
 */
class Collection extends AbstractApi
{
    /**
     * API add to favorites call
     * @param $assetId
     * @return Object
     */
    public function addToFavorites($assetId)
    {
        $params = [
            'asset_id' => $assetId,
            'type' => 'Favorites'
        ];

        return $this->post('collections/assets',
            $params,
            ['token' => $this->apiInstance->getToken()]
        );
    }

    /**
     * API remove from favorites call
     * @param $assetId
     * @return Object
     */
    public function removeFromFavorites($assetId)
    {
        $params = [
            'asset_id' => $assetId,
            'type' => 'Favorites',
            'token' => $this->apiInstance->getToken()
        ];

        return $this->delete('collections/assets', $params);
    }


}