<?php namespace Fopio\AffinityAPI\Responses\Notes;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityNoteObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetNotesResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityNoteObject;

    protected $affinity_note_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_note_objects = [];

        if(isset($affinity_response->Notes->Note)){
            foreach($affinity_response->Notes->Note as $affinity_note){
                $this->appendObject($affinity_note);
            }
        }elseif(isset($affinity_response->Note)){
            $this->appendObject($affinity_response->Note);
        }

        return $this;
    }

    protected function appendObject($affinity_note){
        $affinity_tariff_object = new AffinityNoteObject();

        $affinity_tariff_object->setObject($affinity_note);

        $this->affinity_note_objects[] = $affinity_tariff_object;
    }

    public function getResponse(): array
    {
        return $this->affinity_note_objects;
    }
}