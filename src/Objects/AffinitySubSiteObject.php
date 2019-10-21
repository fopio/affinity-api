<?php namespace Fopio\AffinityAPI\Objects;

class AffinitySubSiteObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['sub_site_id'] = null;
        $this->response_array['sub_site_uid'] = null;
        $this->response_array['site_id'] = null;
        $this->response_array['name'] = null;
        $this->response_array['address_id'] = null;
        $this->response_array['sub_site_ref'] = null;
        $this->response_array['live'] = null;
        $this->response_array['sub_site_address'] = null;
    }

    public function setObject(\stdClass $affinity_response)
    {
        $this->raw_response = $affinity_response;

        $this->response_array['sub_site_id'] = $this->integerField($affinity_response->SubsiteID);
        $this->response_array['sub_site_uid'] = $this->stringField($affinity_response->SubsiteUID);
        $this->response_array['site_id'] = $this->integerField($affinity_response->SiteID);
        $this->response_array['name'] = $this->stringField($affinity_response->SubSiteName);
        $this->response_array['address_id'] = $this->integerField($affinity_response->AddressID);
        $this->response_array['sub_site_ref'] = $this->stringField($affinity_response->SubSiteRef1);
        $this->response_array['live'] = $this->booleanField($affinity_response->Live);
        $this->response_array['sub_site_address'] = $this->stringField($affinity_response->SubSiteAddress);
    }

    public function getSubSiteID():? int
    {
        return $this->response_array['sub_site_id'];
    }

    public function getSubSiteUID():? string
    {
        return $this->response_array['sub_site_uid'];
    }

    public function getSiteID():? int
    {
        return $this->response_array['site_id'];
    }

    public function getName():? string
    {
        return $this->response_array['name'];
    }

    public function getAddressID():? int
    {
        return $this->response_array['address_id'];
    }

    public function getSubSiteRef():? string
    {
        return $this->response_array['sub_site_ref'];
    }

    public function getLive():? bool
    {
        return $this->response_array['live'];
    }

    public function getSubSiteAddress():? int
    {
        return $this->response_array['sub_site_address'];
    }


}