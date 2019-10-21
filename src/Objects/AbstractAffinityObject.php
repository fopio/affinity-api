<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\AbstractResponseInterface;

abstract class AbstractAffinityObject
{
    protected $raw_response;

    protected $response_array;

    /**
     * Returns the response as an array
     * @return array
     */
    public function getResponseAsArray(): array
    {
        return $this->response_array;
    }

    /**
     * Returns the response as object
     * @return \stdClass
     */
    public function getResponseAsObject(): \stdClass
    {
        return (object)$this->response_array;
    }

    /**
     * Returns the raw response from Affinity
     * @return \stdClass
     */
    public function getRawResponse(): \stdClass
    {
        return $this->raw_response;
    }
    /**
     * Get integer field
     * @param $field
     * @return int|string
     */
    protected function integerField($field){
        return is_string($field) ? (int)$field : 0;
    }

    /**
     * Get string field
     * @param $field
     * @return string
     */
    protected function stringField($field)
    {
        return is_string($field) ? $field : '';
    }

    /**
     * Get bool field
     * @param $field
     * @return string
     */
    protected function booleanField($field)
    {
        if(is_string($field)) return (int)$field == 1;

        return false;
    }

}