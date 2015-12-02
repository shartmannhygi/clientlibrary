<?php
namespace Upg\Library\Api\Exception;

/**
 * Class Validation
 * Raised if the request does not pass presending validation
 * @package Upg\Library\Api\Exception
 */
class Validation extends AbstractException
{
    private $vailidationResults;

    public function __construct($vailidationResults)
    {
        $this->vailidationResults = $vailidationResults;
        parent::__construct("Validation did not pass");
    }

    public function getVailidationResults()
    {
        return $this->vailidationResults;
    }
}
