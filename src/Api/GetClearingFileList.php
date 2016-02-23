<?php
namespace Upg\Library\Api;

use Upg\Library\Config;

/**
 * Class GetCaptureStatus
 * The API stub method for the getCaptureStatus call
 * @link http://www.manula.com/manuals/payco/payment-api/hostedpagesdraft/en/topic/getcapturestatus
 * @package Upg\Library\Api
 */
class GetClearingFileList extends AbstractApi
{
    /**
     * URI for the call
     */
    const GET_CLEARING_FILE_LIST_PATH = 'getClearingFileList';

    /**
     * Construct the stub
     * @param Config $config Merchant config
     * @param \Upg\Library\Request\GetCaptureStatus $request Request to be sent
     */
    public function __construct(Config $config, \Upg\Library\Request\GetClearingFileList $request)
    {
        $this->request = $request;
        parent::__construct($config);
    }

    /**
     * Get the URL
     * @return string
     */
    public function getUrl()
    {
        $baseUrl = $this->getBaseUrl();
        return $this->combineUrlUri($baseUrl, self::GET_CLEARING_FILE_LIST_PATH);
    }
}