<?php namespace Fopio\AffinityAPI\Responses\Companies;

use Fopio\AffinityAPI\Objects\AffinityCompanyObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetCompaniesResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityCompanyObject;

    protected $affinity_company_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_company_objects = [];

        if(isset($affinity_response->Companies->Company)){
            foreach($affinity_response->Companies->Company as $affinity_company){
                $this->appendObject($affinity_company);
            }
        }elseif(isset($affinity_response->Company)){
            $this->appendObject($affinity_response->Contract);
        }

        return $this;
    }

    protected function appendObject($affinity_company){
        $affinity_company_object = new AffinityCompanyObject();

        $affinity_company_object->setObject($affinity_company);

        $this->affinity_company_objects[] = $affinity_company_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_company_objects;
    }
}