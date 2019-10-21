<?php namespace Fopio\AffinityAPI\Responses\Teams;

use Fopio\AffinityAPI\Objects\AffinityTeamObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTeamsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTeamObject;

    protected $affinity_team_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_team_objects = [];

        foreach($affinity_response->AffinityTeams->AffinityTeam as $affinity_team){
            $affinity_team_object = new AffinityTeamObject();

            $affinity_team_object->setObject($affinity_team);

            $this->affinity_team_objects[] = $affinity_team_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_team_objects;
    }
}