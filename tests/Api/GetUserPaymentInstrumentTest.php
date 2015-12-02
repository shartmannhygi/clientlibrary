<?php

namespace Upg\Library\Tests\Api;

use Upg\Library\Api\GetUserPaymentInstrument as GetUserPaymentInstrumentApi;
use Upg\Library\Request\GetUserPaymentInstrument;
use Upg\Library\Config;

class GetUserPaymentInstrumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Config object for tests
     * @var Config
     */
    private $config;

    public function setUp()
    {
        $this->config = new Config(array(
            'merchantPassword' => '8A!v#6qPc3?+G1on',
            'merchantID' => '123',
            'storeID' => 'test Store',
            'sendRequestsWithSalt' => true,
            'baseUrl' => "http://www.something.com/"
        ));
    }

    public function tearDown()
    {
        unset($this->config);
    }

    public function testGetUrl()
    {
        $request = new GetUserPaymentInstrument($this->config);

        $api = new GetUserPaymentInstrumentApi($this->config, $request);

        $this->assertEquals('http://www.something.com/getUserPaymentInstrument', $api->getUrl());
    }
}
