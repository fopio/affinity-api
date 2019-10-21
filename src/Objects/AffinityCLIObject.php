<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityCLIObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['cli_id'] = null;
        $this->response_array['cli_uid'] = null;
        $this->response_array['cli_number'] = null;
        $this->response_array['description'] = false;
        $this->response_array['site_id'] = null;
        $this->response_array['sub_site_id'] = null;
        $this->response_array['live'] = false;
        $this->response_array['date_live'] = null;
        $this->response_array['date_entered'] = null;
        $this->response_array['start_date'] = null;
        $this->response_array['end_date'] = null;
    }

    public function setObject(\stdClass $affinity_cli_response)
    {
        $this->raw_response = $affinity_cli_response;

        $this->response_array['cli_id'] = $this->integerField($affinity_cli_response->CLIID);
        $this->response_array['cli_uid'] = $this->stringField($affinity_cli_response->CLIUID);
        $this->response_array['cli_number'] = $this->stringField($affinity_cli_response->CLINumber);
        $this->response_array['description'] = $this->stringField($affinity_cli_response->Description);
        $this->response_array['site_id'] = $this->integerField($affinity_cli_response->SiteID);
        $this->response_array['sub_site_id'] = $this->integerField($affinity_cli_response->SubSiteID);
        $this->response_array['live'] = $this->booleanField($affinity_cli_response->Live);
        $this->response_array['date_live'] = $this->carbonDateFromAffinityField($affinity_cli_response->DateLive);
        $this->response_array['date_entered'] = $this->carbonDateFromAffinityField($affinity_cli_response->DateEntered);
        $this->response_array['start_date'] = $this->carbonDateFromAffinityField($affinity_cli_response->StartDate);
        $this->response_array['end_date'] = $this->carbonDateFromAffinityField($affinity_cli_response->EndDate);
     }

    public function getCLIID():? int
    {
        return $this->response_array['cli_id'];
    }

    public function getCLIUID(): string
    {
        return $this->response_array['cli_uid'];
    }

    public function getCLINumber():? string
    {
        return $this->response_array['cli_number'];
    }

    public function getDescription():? string
    {
        return $this->response_array['description'];
    }

    public function getSiteID():? int
    {
        return $this->response_array['site_id'];
    }

    public function getSubSiteID():? int
    {
        return $this->response_array['sub_site_id'];
    }

    public function getLive():? bool
    {
        return $this->response_array['live'];
    }

    public function getDateLive():? Carbon
    {
        return $this->response_array['date_live'];
    }

    public function getDateEntered():? Carbon
    {
        return $this->response_array['date_entered'];
    }

    public function getStartDate():? Carbon
    {
        return $this->response_array['start_date'];
    }

    public function getEndDate():? Carbon
    {
        return $this->response_array['end_date'];
    }
}