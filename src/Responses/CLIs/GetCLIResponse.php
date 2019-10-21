<?php namespace Fopio\AffinityAPI\Responses\CLIs;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetCLIResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityCLIObject;

    public function __construct()
    {
        $this->affinityCLIObject = new AffinityCLIObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityCLIObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityCLIObject
    {
        return $this->affinityCLIObject;
    }
}