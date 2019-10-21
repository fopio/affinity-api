<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityAssignedTariffObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['assigned_tariff_id'] = null;
        $this->response_array['site_id'] = null;
        $this->response_array['scheme_id'] = null;
        $this->response_array['start_date'] = null;
        $this->response_array['end_date'] = null;
        $this->response_array['last_edited'] = null;
    }

    public function setObject(\stdClass $affinity_response)
    {
        $this->raw_response = $affinity_response;

        $this->response_array['assigned_tariff_id'] = $this->integerField($affinity_response->ID);
        $this->response_array['site_id'] = $this->integerField($affinity_response->SiteID);
        $this->response_array['scheme_id'] = $this->integerField($affinity_response->SchemeID);
        $this->response_array['start_date'] = $this->carbonDateFromAffinityField($affinity_response->StartDate);
        $this->response_array['end_date'] = $this->carbonDateFromAffinityField($affinity_response->EndDate);
        $this->response_array['last_edited'] = $this->carbonDateFromAffinityField($affinity_response->LastEdited);
    }

    public function getAssignedTariffID():? int
    {
        return $this->response_array['assigned_tariff_id'];
    }

    public function getSchemeID():? int
    {
        return $this->response_array['scheme_id'];
    }

    public function getSiteID():? int
    {
        return $this->response_array['site_id'];
    }

    public function getStartDate():? Carbon
    {
        return $this->response_array['start_date'];
    }

    public function getEndDate():? Carbon
    {
        return $this->response_array['end_date'];
    }

    public function getLastEdited():? Carbon
    {
        return $this->response_array['last_edited'];
    }
}