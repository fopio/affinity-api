<?php namespace Fopio\AffinityAPI\Responses\Users;

use Fopio\AffinityAPI\Objects\AffinityTicketObject;
use Fopio\AffinityAPI\Objects\AffinityUserObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetUserResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityUserObject;

    public function __construct()
    {
        $this->affinityUserObject = new AffinityUserObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityUserObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityUserObject
    {
        return $this->affinityUserObject;
    }
}