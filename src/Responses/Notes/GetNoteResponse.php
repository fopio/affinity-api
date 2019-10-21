<?php namespace Fopio\AffinityAPI\Responses\Notes;

use Fopio\AffinityAPI\Objects\AffinityNoteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetNoteResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityNoteObject;

    public function __construct()
    {
        $this->affinityNoteObject = new AffinityNoteObject();
    }

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinityNoteObject->setObject($affinity_response);

        return $this;
    }

    public function getResponse(): AffinityNoteObject
    {
        return $this->affinityNoteObject;
    }
}