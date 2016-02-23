<?php
namespace Upg\Library\Request;

/**
 * Class GetClearingFileList
 * @package Upg\Library\Request
 * @link https://www.manula.com/manuals/payco/payment-api/hostedpagesdraft/en/topic/getclearingfilelist
 */
class GetClearingFileList extends AbstractRequest
{
    /**
     * 	the from date is including
     * @var \DateTime
     */
    private $from;

    /**
     * 	the to date is including
     * @var \DateTime
     */
    private $to;

    /**
     * Set the from field in the request
     * @see GetClearingFileList::$from
     * @param \DateTime $from
     * @return $this
     */
    public function setFrom(\DateTime $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get the value of the from field
     * @see GetClearingFileList::$from
     * @return \DateTime
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the to field
     * @see GetClearingFileList::$to
     * @param \DateTime $to
     * @return $this
     */
    public function setTo(\DateTime $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Get value of the to field
     * @see GetClearingFileList::$to
     * @return \DateTime
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Get the serializer data
     * @return array
     */
    public function getPreSerializerData()
    {
        $return = array();

        if($this->from instanceof \DateTime)
        {
            $return['from'] = $this->getFrom()->format('Y-m-d');
        }

        if($this->to instanceof \DateTime)
        {
            $return['to'] = $this->getTo()->format('Y-m-d');
        }

        return $return;
    }

    /**
     * Get the validation data
     * @return array
     */
    public function getClassValidationData()
    {
        $validationData = array();

        $validationData['from'][] = array(
            'name' => 'required',
            'value' => null,
            'message' => "from date is required"
        );

        return $validationData;
    }
}