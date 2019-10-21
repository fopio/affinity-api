<?php namespace Fopio\AffinityAPI\Responses\Products;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityNoteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetProductResponse extends AbstractResponse implements ResponseInterface
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