<?php

namespace Upg\Library\Tests\Request;

use Faker\Factory;
use Upg\Library\Config;
use Upg\Library\Request\DeleteUserPaymentInstrument;
use Upg\Library\Validation\Validation;

class DeleteUserPaymentInstrumentTest extends AbstractRequestTest
{
    /**
     * @var string A very long string
     */
    private $veryLongString;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * Config object for tests
     * @var Config
     */
    private $config;

    public function setUp()
    {
        $faker = Factory::create();

        $this->veryLongString = preg_replace("/[^A-Za-z0-9]/", '', $faker->sentence(90));
        $this->faker = $faker;

        $this->config = new Config(array(
            'merchantPassword' => '8A!v#6qPc3?+G1on',
            'merchantID' => '123',
            'storeID' => 'test Store',
            'sendRequestsWithSalt' => true,
        ));
    }

    public function tearDown()
    {
        unset($this->faker);
        unset($this->config);
    }

    public function testDeleteUserPaymentInstrumentValidationSuccess()
    {
        $request = new DeleteUserPaymentInstrument($this->config);
        $request->setPaymentInstrumentID(1);

        $validation = new Validation();

        $validation->getValidator($request);
        $data = $validation->performValidation();

        $this->assertEmpty($data, "Validation found an issue when there should be none");
    }

    public function testRefundValidationpaymentInstrumentID()
    {
        $request = new DeleteUserPaymentInstrument($this->config);

        /**
         * Test required
         */
        $validation = new Validation();

        $validation->getValidator($request);
        $data = $validation->performValidation();

        $this->assertValidationReturned(
            'Upg\\Library\\Request\\DeleteUserPaymentInstrument',
            'paymentInstrumentID',
            'paymentInstrumentID is required',
            $data,
            "paymentInstrumentID is required failed to trigger"
        );
    }
}
