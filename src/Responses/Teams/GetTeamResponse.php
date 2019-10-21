<?php namespace Fopio\AffinityAPI\Responses\Teams;

use Fopio\AffinityAPI\Objects\AffinityTeamObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTeamResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTeamObject;

    public function __construct()
    {
        $this->affinityTeamObject = new AffinityTeamObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityTeamObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityTeamObject
    {
        return $this->affinityTeamObject;
    }
}