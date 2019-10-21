<?php namespace Fopio\AffinityAPI\Requests\Notes;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class TaskNoteCreateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array;

    protected $required_fields = ['Summary', 'Details', 'Category', 'TaskID'];

    public function __construct()
    {
        $this->request_array['TaskID'] = null;
        $this->request_array['Summary'] = null;
        $this->request_array['Details'] = null;
        $this->request_array['Category'] = null;
    }

    public function summary(string $summary)
    {
        $this->request_array['Summary'] = $summary;

        return $this;
    }

    public function details(string $details)
    {
        $this->request_array['Details'] = $details;

        return $this;
    }

    public function taskID(int $ticket_id)
    {
        $this->request_array['TaskID'] = $ticket_id;

        return $this;
    }

    public function category(string $category)
    {
        $this->request_array['Category'] = $category;

        return $this;
    }

    public function getSummary()
    {
        return $this->request_array['Summary'];
    }

    public function getDetails()
    {
        return $this->request_array['Details'];
    }

    public function getTaskID()
    {
        return $this->request_array['TaskID'];
    }

    public function getCategory()
    {
        return $this->request_array['Category'];
    }
}