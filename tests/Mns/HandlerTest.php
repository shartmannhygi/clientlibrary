<?php

namespace Upg\Library\Tests\Mns;

use Upg\Library\Mns\Handler;
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

    public function testSuccessfulProcess()
    {
        $data = array(
            'merchantID' => 1,
            'storeID' => 2,
            'orderNo' => 3,
            'confirmationId' => 4,
            'merchantReference' => 5,
            'paymentReference' => 6,
            'userID' => 7,
            'resultCode' => 8,
            'amount' => 9,
            'currencyCode' => 10,
            'previousTransactionStatus' => 11,
            'transactionStatus' => 12,
            'orderStatus' => 13,
            'previousOrderStatus' => 14,
            'additionalInfo' => 15,
            'timestamp' => 16,
            'version' => 1.5,
            'mac' => '3cf5bedbf28c77ab98f57a630c466c0f3d7528cf',
        );

        $processor = new \Upg\Library\Tests\Mock\Mns\MockProcessor();

        $handler = new Handler($this->config, $data, $processor);
        $handler->run();

        $this->assertArraySubset($processor->data, $data);
    }

    /**
     * Test if ParamNotProvided exception is thrown
     * @expectedException Upg\Library\Mns\Exception\ParamNotProvided
     */
    public function testParamNotProvidedException()
    {
        $data = array(
            'storeID' => 2,
            'orderNo' => 3,
            'confirmationId' => 4,
            'merchantReference' => 5,
            'paymentReference' => 6,
            'userID' => 7,
            'resultCode' => 8,
            'amount' => 9,
            'currencyCode' => 10,
            'previousTransactionStatus' => 11,
            'transactionStatus' => 12,
            'orderStatus' => 13,
            'previousOrderStatus' => 14,
            'additionalInfo' => 15,
            'timestamp' => 16,
            'version' => 1.5,
            'mac' => '3cf5bedbf28c77ab98f57a630c466c0f3d7528cf',
        );

        $processor = new \Upg\Library\Tests\Mock\Mns\MockProcessor();
        $handler = new Handler($this->config, $data, $processor);
    }

    /**
     * Test if the mac validation exception is thrown
     * @expectedException Upg\Library\Callback\Exception\MacValidation
     */
    public function testMacValidationException()
    {
        $data = array(
            'merchantID' => 1,
            'storeID' => 2,
            'orderNo' => 3,
            'confirmationId' => 4,
            'merchantReference' => 5,
            'paymentReference' => 6,
            'userID' => 7,
            'resultCode' => 8,
            'amount' => 9,
            'currencyCode' => 10,
            'previousTransactionStatus' => 11,
            'transactionStatus' => 12,
            'orderStatus' => 13,
            'previousOrderStatus' => 14,
            'additionalInfo' => 15,
            'timestamp' => 16,
            'version' => 1.5,
            'mac' => '3cf5bedbf28c77ab98f57a630c466c0f3dbbbbbb',
        );

        $processor = new \Upg\Library\Tests\Mock\Mns\MockProcessor();

        $handler = new Handler($this->config, $data, $processor);
    }
}
