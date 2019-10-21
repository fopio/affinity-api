<?php namespace Fopio\AffinityAPI\Objects;

class AffinityAddressObject extends AbstractAffinityObject implements AffinityObjectInterface
{
    protected $raw_response;

    protected $response_array = [];

    public function __construct()
    {
        //$this->response_array['team_id'] = null;
    }

    public function setObject(\stdClass $affinity_team_response)
    {
        $this->raw_response = $affinity_team_response;

        //$this->response_array['team_id'] = $this->integerField($affinity_team_response->TeamId);
    }

    public function getTeamID():? int
    {
        //return $this->response_array['team_id'];
    }


}