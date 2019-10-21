<?php namespace Fopio\AffinityAPI\Responses\Tasks;

use Fopio\AffinityAPI\Objects\AffinityCLIObject;
use Fopio\AffinityAPI\Objects\AffinityTaskObject;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\ResponseInterface;

class GetTasksResponse extends AbstractResponse implements ResponseInterface
{
    protected $affinityTaskObject;

    protected $affinity_tasks_objects = [];

    public function setResponse(\stdClass $affinity_response)
    {
        $this->affinity_tasks_objects = [];

        foreach($affinity_response->Tasks->Task as $affinity_task){
            $affinity_task_object = new AffinityTaskObject();

            $affinity_task_object->setObject($affinity_task);

            $this->affinity_tasks_objects[] = $affinity_task_object;
        }

        return $this;
    }

    public function getResponse(): array
    {
        return $this->affinity_tasks_objects;
    }
}