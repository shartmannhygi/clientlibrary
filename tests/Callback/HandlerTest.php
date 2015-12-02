<?php

namespace Upg\Library\Tests\Callback;

use Upg\Library\Callback\Handler;
use Upg\Library\Config;
use Upg\Library\Tests\Mock\Callback\MockProcessor;

class HandlerTest extends \PHPUnit_Framework_TestCase
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

    public function testSuccessfulCallBack()
    {
        $data = array(
            'merchantID' => 10,
            'storeID' => 'store',
            'orderID' => 10,
            'resultCode' => 0,
            'merchantReference' => 'test',
            'message' => 'test',
            'salt' => "randomSalt",
            'mac' => "5074b6c68e7261dc2f0f67c97842389a327b7084"
        );

        $processor = new MockProcessor();

        $handler = new Handler($this->config, $data, $processor);
        $result = $handler->run();

        $expected = json_encode(array('url'=>'http://something.com/success'));

        $this->assertJsonStringEqualsJsonString($expected, $result);

        $this->assertArraySubset($processor->data, $data);
    }

    /**
     * Test if ParamNotProvided exception is thrown
     * @expectedException Upg\Library\Callback\Exception\ParamNotProvided
     */
    public function testParamException()
    {
        $data = array(
            'storeID' => 'store',
            'orderID' => 10,
            'resultCode' => 0,
            'merchantReference' => 'test',
            'message' => 'test'
        );

        $processor = new MockProcessor();

        $handler = new Handler($this->config, $data, $processor);
    }

    /**
     * Test if validation exception is thrown
     * @expectedException Upg\Library\Callback\Exception\MacValidation
     */
    public function testMacValidationException()
    {
        $data = array(
            'merchantID' => 10,
            'storeID' => 'store',
            'orderID' => 10,
            'resultCode' => 0,
            'merchantReference' => 'test',
            'message' => 'test',
            'salt' => "randomSalt",
            'mac' => "TESTMAC"
        );

        $processor = new MockProcessor();

        $handler = new Handler($this->config, $data, $processor);
        $result = $handler->run();
    }
}
