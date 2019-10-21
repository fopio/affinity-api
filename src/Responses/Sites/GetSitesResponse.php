<?php namespace Fopio\AffinityAPI\Responses\Sites;

use Fopio\AffinityAPI\Objects\AffinitySiteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetSitesResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTicketObject;

    protected $affinity_site_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_site_objects = [];

        if(isset($affinity_response->Sites->Site)){
            foreach($affinity_response->Sites->Site as $affinity_site){
                $this->appendObject($affinity_site);
            }
        }elseif(isset($affinity_response->Site)){
            $this->appendObject($affinity_response->Site);
        }

        return $this;
    }

    protected function appendObject($affinity_site){
        $affinity_site_object = new AffinitySiteObject();

        $affinity_site_object->setObject($affinity_site);

        $this->affinity_site_objects[] = $affinity_site_object;
    }


    public function getResponse(): array
    {
        return $this->affinity_site_objects;
    }
}