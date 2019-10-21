<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityTariffObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    use DatesTrait;

    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['scheme_id'] = null;
        $this->response_array['scheme_uid'] = null;
        $this->response_array['dealer_id'] = null;
        $this->response_array['name'] = null;
        $this->response_array['description'] = null;
        $this->response_array['enabled'] = null;
        $this->response_array['last_edited'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['scheme_id'] = $this->integerField($affinity_team_response->SchemeID);
        $this->response_array['scheme_uid'] = $this->stringField($affinity_team_response->SchemeUID);
        $this->response_array['dealer_id'] = $this->integerField($affinity_team_response->DealerID);
        $this->response_array['name'] = $this->stringField($affinity_team_response->SchemeName);
        $this->response_array['description'] = $this->stringField($affinity_team_response->Description);
        $this->response_array['enabled'] = $this->booleanField($affinity_team_response->Enabled);
        $this->response_array['last_edited'] = $this->carbonDateFromAffinityField($affinity_team_response->LastEdited);
    }

    public function getSchemeID():? int
    {
        return $this->response_array['scheme_id'];
    }

    public function getSchemeUID():? string
    {
        return $this->response_array['scheme_uid'];
    }

    public function getDealerID():? int
    {
        return $this->response_array['dealer_id'];
    }

    public function getName():? string
    {
        return $this->response_array['name'];
    }

    public function getDescription():? string
    {
        return $this->response_array['description'];
    }

    public function getEnabled():? bool
    {
        return $this->response_array['enabled'];
    }

    public function getLastEdited():? Carbon
    {
        return $this->response_array['last_edited'];
    }
}