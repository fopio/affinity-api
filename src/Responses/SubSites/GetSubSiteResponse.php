<?php namespace Fopio\AffinityAPI\Responses\SubSites;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinitySubSiteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetSubSiteResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinitySubSitesObject;

    public function __construct()
    {
        $this->affinitySubSitesObject = new AffinitySubSiteObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinitySubSitesObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinitySubSiteObject
    {
        return $this->affinitySubSitesObject;
    }
}