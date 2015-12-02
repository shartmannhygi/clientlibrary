<?php

namespace Upg\Library\Callback;

/**
 * Interface ProcessorInterface
 * Processor interface which needs to be implemented in the integration for the handler
 * To call once request passes validation
 * @package Upg\Library\Callback
 */
interface ProcessorInterface
{
    /**
     * Send data to the processor that will be used in the run method
     * Unless specified most parameters will not be blank
     *
     * @param $merchantID This is the merchantID assigned by PayCo.
     * @param $storeID This is the store ID of a merchant assigned by PayCo as a merchant can have more than one store.
     * @param $orderID This is the order number of the shop.
     * @param $resultCode 0 means OK, any other code means error
     * @param $merchantReference Reference that was set by the merchant during the createTransaction call. Optional
     * @param $message Details about an error, otherwise not present. Optional
     */
    public function sendData($merchantID, $storeID, $orderID, $resultCode, $merchantReference, $message);

    /**
     * The run method.
     * This should return the appropriate url as shown in the manual under the Callback on the link provided for this
     * method.
     * The implementation must return either a sucessful url or an error url to payco.
     * @link http://www.manula.com/manuals/payco/payment-api/hostedpagesdraft/en/topic/reserve
     * @return string The url as a raw string
     */
    public function run();
}
