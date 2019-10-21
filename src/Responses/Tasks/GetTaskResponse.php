<?php namespace Fopio\AffinityAPI\Responses\Tasks;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityTaskObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTaskResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTaskObject;

    public function __construct()
    {
        $this->affinityTaskObject = new AffinityTaskObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityTaskObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityTaskObject
    {
        return $this->affinityTaskObject;
    }
}