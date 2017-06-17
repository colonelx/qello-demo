<?php


class ResponseHandlerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testSuccessResponse()
    {
        $json = '{"status":{"success":true,"execution_time":"2.00 ms"}}';
        $responseHandler = new \QKidsDemo\Library\HttpClient\ResponseHandler($json);
        $responseObject = $responseHandler->getResponse();
        $this->assertTrue( $responseObject->status->success );
    }

    public function testApiExceptionError()
    {
        $e = null;
        try {
            $json = '{"status":{"success":false,"message":"Random API Error","error":10006}}';
            new \QKidsDemo\Library\HttpClient\ResponseHandler($json);
        } catch (Exception $ex) {
            $e = $ex;
        }

        $this->assertTrue($e instanceof \QKidsDemo\Exception\QelloApiErrorException);
        $this->assertEquals(10006, $e->getCode());
        $this->assertEquals("Random API Error", $e->getMessage());
    }

    public function testApiEmptyResponse()
    {
        $e = null;
        try {
            $json = '';
            new \QKidsDemo\Library\HttpClient\ResponseHandler($json);
        } catch (Exception $ex) {
            $e = $ex;
        }
        $this->assertTrue($e instanceof \QKidsDemo\Exception\QelloApiException);
    }
}