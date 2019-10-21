<?php namespace Fopio\AffinityAPI\API;

use Fopio\AffinityAPI\Requests\Tasks\TaskCreateRequest;
use Fopio\AffinityAPI\Requests\Tasks\TaskUpdateRequest;
use Fopio\AffinityAPI\Responses\Tasks\GetTaskResponse;
use Fopio\AffinityAPI\Responses\Tasks\GetTasksResponse;

/**
 * Class AffinityTaskAPI
 * @package App\Packages\Affinity
 */
class AffinityTaskAPI extends AffinityAPICore
{
    protected $get_task_response;

    protected $get_tasks_response;

    public function __construct()
    {
        $this->get_task_response = new GetTaskResponse();

        $this->get_tasks_response = new GetTasksResponse();

        parent::__construct();
    }

    /**
     * Get a task based on the task id
     * @param $task_id
     * @throws \Exception
     * @return GetTaskResponse
     */
    protected function getTaskByID(int $task_id):?GetTaskResponse
    {
        $response = $this->client->XmlGetTaskByID(array('identityToken' => $this->getToken(), 'taskID' => $task_id));

        if($this->errorResponse($response->XmlGetTaskByIDResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetTaskByIDResult->Result);

        $this->get_task_response->setResponse($result->Task);

        return $this->get_task_response;
    }

    /**
     * Creates a task
     * @param TaskCreateRequest $taskCreateRequest
     * @throws \Exception
     * @return object
     */
    protected function createTask(TaskCreateRequest $taskCreateRequest)
    {
        $task_xml = $this->arrayToXMLString($taskCreateRequest->getRequestArray(), 'Task');

        $response = $this->client->XmlAddTask(array('identityToken' => $this->getToken(), 'taskXml' => $task_xml));

        if($this->errorResponse($response->XmlAddTaskResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlAddTaskResult->Result);
    }


    /**
     * Update a task by ID
     * @param int $task_id
     * @param TaskUpdateRequest $taskUpdateRequest
     * @throws \Exception
     * @return object
     */
    protected function updateTask(int $task_id, TaskUpdateRequest $taskUpdateRequest)
    {
        $task_xml = $this->arrayToXMLString($taskUpdateRequest->getRequestArray(), 'Task');

        $response = $this->client->XmlUpdateTaskByID(array('identityToken' => $this->getToken(),
            'taskID' => $task_id,
            'taskXml' => $task_xml));

        if($this->errorResponse($response->XmlUpdateTaskByIDResult)) throw new \Exception('Affinity missing results');

        return $this->xmlToObject($response->XmlUpdateTaskByIDResult->Result);
    }

    /**
     * Gets selection of tasks based on query
     * @param Filter $filter
     * @param int $offset
     * @param int $qty
     * @param Projection $projection
     * @param Ordering $ordering
     * @throws \Exception
     * @return GetTasksResponse
     */
    protected function getTasks(Filter $filter, $offset = 0, $qty = 30, ?Projection $projection = null, ?Ordering $ordering = null):?GetTasksResponse
    {
        if(!$projection) $projection = $this->default_projection;

        if(!$ordering) $ordering = $this->default_ordering->create()->field('TaskID', 'Asc');

        $response = $this->client->XmlQueryTasks(array('identityToken' => $this->getToken(), 'numberOfItemsToSkip' => $offset, 'numberOfItemsToTake' => $qty, 'filterXml' => $filter->getFilterXML(), 'projectionXml' => $projection->getProjectionXML(), 'orderingXml' => $ordering->getOrderingXML()));

        if($this->errorResponse($response->XmlQueryTasksResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlQueryTasksResult->Result);

        $this->get_tasks_response->setResponse($result);

        return $this->get_tasks_response;
    }


    /**
     * Returns qty of tasks based on query
     * @param Filter $filter
     * @throws \Exception
     * @return int
     */
    protected function getTaskCount(Filter $filter):int
    {
        $response = $this->client->XmlGetTaskCount(array('identityToken' => $this->getToken(), 'filterXml' => $filter->getFilterXML()));

        if($this->errorResponse($response->XmlGetTaskCountResult)) throw new \Exception('Affinity missing results');

        $result = $this->xmlToObject($response->XmlGetTaskCountResult->Result);

        return (int)$result->TaskCount;
    }

}