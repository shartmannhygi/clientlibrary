<?php

namespace Upg\Library\Tests\Request;

use Faker\Factory;
use Upg\Library\Config;
use Upg\Library\Request\GetClearingFileList;
use Upg\Library\Validation\Validation;

class GetClearingFileListTest extends AbstractRequestTest
{
    /**
     * Config object for tests
     * @var Config
     */
    private $config;

    /**
     * faker
     * @var
     */
    private $faker;

    public function setUp()
    {
        $this->faker = Factory::create();

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

    public function testGetClearingFileListValidationSuccess()
    {
        $request = new GetClearingFileList($this->config);
        $request->setFrom($this->faker->dateTimeThisYear())
            ->setTo($this->faker->dateTimeThisYear());

        $validation = new Validation();
        $validation->getValidator($request);
        $data = $validation->performValidation();

        $this->assertEmpty($data, "Validation found an issue when there should be none");
    }

    public function testGetClearingFileListValidationFailureFromRequired()
    {
        $request = new GetClearingFileList($this->config);
        $request->setTo($this->faker->dateTimeThisYear());

        $validation = new Validation();
        $validation->getValidator($request);
        $data = $validation->performValidation();

        $this->assertValidationReturned(
            'Upg\\Library\\Request\\GetClearingFileList',
            'from',
            'from date is required',
            $data,
            "from date is required failed to trigger"
        );
    }
}