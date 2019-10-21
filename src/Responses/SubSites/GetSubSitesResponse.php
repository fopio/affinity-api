<?php namespace Fopio\AffinityAPI\Responses\SubSites;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinitySubSiteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetSubSitesResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinitySubSitesObject;

    protected $affinity_sub_site_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_sub_site_objects = [];

        if(isset($affinity_response->SubSites->SubSite)){
            foreach($affinity_response->SubSites->SubSite as $affinity_sub_site){
                $this->appendObject($affinity_sub_site);
            }
        }elseif(isset($affinity_response->SubSite)){
            $this->appendObject($affinity_response->SubSite);
        }

        return $this;
    }

    protected function appendObject($affinity_sub_site){
        $affinity_sub_site_object = new AffinitySubSiteObject();

        $affinity_sub_site_object->setObject($affinity_sub_site);

        $this->affinity_sub_site_objects[] = $affinity_sub_site_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_sub_site_objects;
    }
}