<?php namespace Fopio\AffinityAPI\Objects;

class AffinityCompanyObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['company_id'] = null;
        $this->response_array['company_uid'] = null;
        $this->response_array['name'] = null;
        $this->response_array['dealer_id'] = null;
        $this->response_array['company_reg'] = null;
        $this->response_array['web_address'] = null;
        $this->response_array['company_address_id'] = null;
        $this->response_array['company_ref'] = null;
        $this->response_array['company_identity_id'] = null;
        $this->response_array['company_address'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['company_id'] = $this->integerField($affinity_team_response->CompanyID);
        $this->response_array['company_uid'] = $this->stringField($affinity_team_response->CompanyUID);
        $this->response_array['name'] = $this->stringField($affinity_team_response->CompanyName);
        $this->response_array['dealer_id'] = $this->integerField($affinity_team_response->DealerID);
        $this->response_array['company_reg'] = $this->stringField($affinity_team_response->CompanyRegNo);
        $this->response_array['web_address'] = $this->stringField($affinity_team_response->WebAddress);
        $this->response_array['company_address_id'] = $this->integerField($affinity_team_response->CompanyAddressID);
        $this->response_array['company_ref'] = $this->stringField($affinity_team_response->CompanyRef);
        $this->response_array['company_identity_id'] = $this->integerField($affinity_team_response->CustomerIdentityID);
        $this->response_array['company_address'] = $this->stringField($affinity_team_response->CompanyAddress);
    }

    public function getCompanyID():? int
    {
        return $this->response_array['team_id'];
    }

    public function getCompanyUID():? string
    {
        return $this->response_array['company_uid'];
    }

    public function getName():? string
    {
        return $this->response_array['name'];
    }

    public function getDealerID():? int
    {
        return $this->response_array['dealer_id'];
    }

    public function getCompanyReg():? string
    {
        return $this->response_array['company_reg'];
    }

    public function getCompanyRef():? string
    {
        return $this->response_array['company_ref'];
    }

    public function getWebAddress():? string
    {
        return $this->response_array['web_address'];
    }

    public function getCompanyAddressID():? int
    {
        return $this->response_array['company_address_id'];
    }

    public function getCompanyIdentityID():? int
    {
        return $this->response_array['company_identity_id'];
    }

    public function getCompanyAddress():? string
    {
        return $this->response_array['company_address'];
    }
}