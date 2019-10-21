<?php namespace Fopio\AffinityAPI\Responses\Dealers;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetDealerResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityDealerObject;

    public function __construct()
    {
        $this->affinityDealerObject = new AffinityCLIObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityDealerObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityCLIObject
    {
        return $this->affinityDealerObject;
    }
}