<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Traits\DatesTrait;

class AffinityTeamObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        $this->response_array['team_id'] = null;
        $this->response_array['team_uid'] = null;
        $this->response_array['team_name'] = null;
        $this->response_array['disabled'] = false;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        $this->response_array['team_id'] = $this->integerField($affinity_team_response->TeamId);
        $this->response_array['team_uid'] = $this->stringField($affinity_team_response->TeamUID);
        $this->response_array['team_name'] = $this->stringField($affinity_team_response->TeamName);
        $this->response_array['disabled'] = $this->booleanField($affinity_team_response->Disabled);
    }

    public function getTeamID():? int
    {
        return $this->response_array['team_id'];
    }

    public function getTeamUID(): string
    {
        return $this->response_array['team_uid'];
    }

    public function getTeamName():? string
    {
        return $this->response_array['team_name'];
    }

    public function getDisabled():? bool
    {
        return $this->response_array['disabled'];
    }
}