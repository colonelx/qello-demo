<?php

namespace QKidsDemo\Library\QelloApi;


class Collection extends AbstractApi
{
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