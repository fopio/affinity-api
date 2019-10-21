<?php namespace Fopio\AffinityAPI\Responses\Sites;

use Fopio\AffinityAPI\Objects\AffinitySiteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetSiteResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinitySiteObject;

    public function __construct()
    {
        $this->affinitySiteObject = new AffinitySiteObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinitySiteObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinitySiteObject
    {
        return $this->affinitySiteObject;
    }
}