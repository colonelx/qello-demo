<?php


class QelloApiClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $qelloApi;

    protected function _before()
    {
        $this->qelloApi = new \QKidsDemo\Library\QelloApi('http://localhost', 'testToken');
    }

    protected function _after()
    {
    }

    public function testFetchingHttpClient()
    {
        $this->assertTrue($this->qelloApi->getHttpClient() instanceof \QKidsDemo\Library\HttpClient\HttpClient);
    }

    public function testNonExistingCall()
    {
        $e = null;
        try
        {
            $this->qelloApi->thisMethodDoesNotExist();
        } catch (Exception $ex) {
            $e = $ex;
        }
        $this->assertTrue($e instanceof \BadMethodCallException);
    }

    public function testGetApiEndpoint()
    {
        // should strip the last forward slash
        $qelloApi = new \QKidsDemo\Library\QelloApi('http://localhost/');
        $endpoint = $qelloApi->getApiEndpoint('test');
        $this->assertEquals('http://localhost/test', $endpoint);
    }

    public function testGetTokenApiCall()
    {
        $qelloApiMock = $this->getMockBuilder('\QKidsDemo\Library\QelloApi\Users')
            ->setConstructorArgs([$this->qelloApi])
            ->setMethods(['post'])
            ->getMock();
        $qelloApiMock
            ->method('post')
            ->willReturnCallback( [$this, 'mockPostHttp'] );

        $token = $qelloApiMock->getToken('email@example.com', 'password', 'firstName', 'lastName');
        $this->assertEquals('testToken', $token);
    }

    public function testGetAssetsApiCall()
    {
        $qelloApiMock = $this->getMockBuilder('\QKidsDemo\Library\QelloApi\Content')
            ->setConstructorArgs([$this->qelloApi, ['Episode', 'Video']])
            ->setMethods(['get'])
            ->getMock();
        $qelloApiMock
            ->method('get')
            ->willReturnCallback( [$this, 'mockGetHttp'] );

        $assets = $qelloApiMock->getAssets();

        $this->assertTrue(is_array($assets));
        $this->assertInstanceOf(\QKidsDemo\Model\Asset::class, $assets[0]);
        $this->assertTrue($assets[0]->isInFavorites());
    }

    public function testFavoritesApiCall()
    {
        $qelloApiMock = $this->getMockBuilder('\QKidsDemo\Library\QelloApi\Collection')
            ->setConstructorArgs([$this->qelloApi, ['Episode', 'Video']])
            ->setMethods(['post', 'delete'])
            ->getMock();
        $qelloApiMock
            ->method('post')->willReturnCallback([$this, 'mockPostHttp']);
        $qelloApiMock
            ->method('delete')->willReturnCallback([$this, 'mockDeleteHttp']);

        $qelloApiMock->addToFavorites(1);
        $qelloApiMock->removeFromFavorites(1);
    }

    public function getValidTokenOutput()
    {
        return $this->getValidResponse('{"status":{"success":true},"data":{"token":"testToken"}}')
            ->getResponse();

        $qelloApiMock->getToken('email@example.com', 'password', 'firstName', 'lastName');
    }

    public function mockPostHttp($path, $getParams, $postParams)
    {
        switch($path)
        {
            case 'users':
                $this->validateTokenCallParams($getParams, $postParams);
                return $this->getValidTokenOutput();
                break;
            case 'collections/assets':
                $this->validateCollectionAddFavoritesCallParams($getParams, $postParams);
                return $this->getValidCollectionAddOutput();
                break;
        }
    }

    public function mockGetHttp($path, $params)
    {
        switch ($path)
        {
            case 'content':
                $this->validateContentCallParams($params);
                return $this->getValidAssetsOutput($params);
                break;
        }
    }

    public function mockDeleteHttp($path, $params)
    {
        switch ($path)
        {
            case 'collections/assets':
                $this->validateCollectionRemoveFavoritesCallParams($params);
                $this->getValidCollectionRemoveCallOutput();
                break;
        }
    }

    private function validateTokenCallParams($postParams, $getParams)
    {
        $this->assertTrue(is_array($postParams));
        $this->assertArrayHasKey('email', $postParams);
        $this->assertArrayHasKey('password', $postParams);
        $this->assertArrayHasKey('first_name', $postParams);
        $this->assertArrayHasKey('last_name', $postParams);
        $this->assertArrayHasKey('device_data', $postParams);
        $this->assertArrayHasKey('device_id', $postParams['device_data']);
        $this->assertArrayHasKey('device_name', $postParams['device_data']);
        $this->assertArrayHasKey('app_version', $postParams['device_data']);
    }

    private function validateContentCallParams($params)
    {
        $this->assertTrue(is_array($params));
        $this->assertArrayHasKey('token', $params);
        $this->assertEquals('testToken', $params['token']);
        $this->assertArrayHasKey('classification', $params);
        $this->assertArrayHasKey('type', $params);
        $this->assertArrayHasKey('offset', $params);
        $this->assertArrayHasKey('limit', $params);
    }

    private function validateCollectionAddFavoritesCallParams($postParams, $getParams)
    {
        $this->assertTrue(is_array($postParams));
        $this->assertArrayHasKey('asset_id', $postParams);
        $this->assertArrayHasKey('type', $postParams);
        $this->assertEquals('Favorites', $postParams['type']);

        $this->assertTrue(is_array($getParams));
        $this->assertArrayHasKey('token', $getParams);
        $this->assertEquals('testToken', $getParams['token']);
    }

    public function validateCollectionRemoveFavoritesCallParams($params)
    {
        $this->assertTrue(is_array($params));
        $this->assertArrayHasKey('asset_id', $params);
        $this->assertArrayHasKey('type', $params);
        $this->assertEquals('Favorites', $params['type']);
        $this->assertArrayHasKey('token', $params);
        $this->assertEquals('testToken', $params['token']);
    }

    public function getValidAssetsOutput($params)
    {
        if(isset($params['collection_type']) && $params['collection_type'] == 'Favorites')
        {
            $json_data = file_get_contents('tests/_data/_assets_favorites.json');
        } else {
            $json_data = file_get_contents('tests/_data/_assets.json');
        }
        return $this->getValidResponse($json_data)->getResponse();
    }

    private function getValidCollectionAddOutput()
    {
        return $this->getValidResponse('{"status":{"success":true,"error":0,"message":"string"},
        "data":{"totalCount":1,"collections":[{"id":1,"name":"string","type":"string"}]}}')->getResponse();
    }

    private function getValidCollectionRemoveCallOutput()
    {
        return $this->getValidResponse('{"status":{"success":true,"error":0,"message":"string"}}')
            ->getResponse();
    }

    private function getValidResponse($json)
    {
        return new \QKidsDemo\Library\HttpClient\ResponseHandler($json);
    }

}