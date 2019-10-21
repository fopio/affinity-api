<?php namespace Fopio\AffinityAPI\Responses\CLIs;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetCLIsResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTicketObject;

    protected $affinity_cli_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_cli_objects = [];

        foreach($affinity_response->CLIs->CLI as $affinity_cli){
            $affinity_cli_object = new AffinityCLIObject();

            $affinity_cli_object->setObject($affinity_cli);

            $this->affinity_cli_objects[] = $affinity_cli_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_cli_objects;
    }
}