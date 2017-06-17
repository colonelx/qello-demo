<?php

namespace QKidsDemo\Library;

use InvalidArgumentException;
use QKidsDemo\Library\HttpClient\HttpClient;
use QKidsDemo\Library\QelloApi as Api;
use QKidsDemo\Model\Device;

class QelloApi
{
    protected $deviceName;
    protected $deviceId;
    protected $appVersion;
    protected $apiEndpoint;
    protected $httpClient;
    protected $token;

    public function __construct($apiEndpoint, $token = null, Device $device = null, $appVersion = null)
    {
        $this->apiEndpoint = $apiEndpoint;
        $this->deviceId = ($device)? $device->getId() : '';
        $this->deviceName = ($device)? $device->getName() : '';
        $this->appVersion = ($appVersion)? $appVersion : '1.0.0';
        $this->token = $token;
        $this->httpClient = new HttpClient();
    }

    public function instance($action, $args = [])
    {
        switch ($action) {
            case 'users':
                $api = new Api\Users($this);
                break;
            case 'collection':
                $api = new Api\Collection($this);
                break;
            case 'content':
                $api = new Api\Content($this, $args);
                break;
            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $action));
        }
        return $api;
    }

    public function __call($name, $args)
    {
        try {
             return $this->instance($name, $args);
        } catch (InvalidArgumentException $e) {
            throw new \BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    public function getDeviceData()
    {
        return [
            'device_id' => $this->deviceId,
            'device_name' => $this->deviceName,
            'app_version' => $this->appVersion
        ];
    }

    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    public function getToken()
    {
        return $this->token;
    }
}
