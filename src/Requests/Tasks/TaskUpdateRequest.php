<?php namespace Fopio\AffinityAPI\Requests\Tasks;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class TaskUpdateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array = [];

    protected $required_fields = [];

    public function __construct()
    {
    }

    /**
     * Check to see if request is valid, in an update any field is required
     * @return bool
     */
    public function isValid()
    {
        return true;
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

    public function priority(int $priority)
    {
        $this->request_array['Priority'] = $priority;

        return $this;
    }

    public function dateDue(Carbon $date_due)
    {
        $this->request_array['DateDue'] = $date_due->toW3cString();

        return $this;
    }

    public function ownerID(int $owner_id)
    {
        $this->request_array['OwnerID'] = $owner_id;

        return $this;
    }

    public function teamID(int $team_id)
    {
        $this->request_array['TeamID'] = $team_id;

        return $this;
    }

    public function category(string $category)
    {
        $this->request_array['Category'] = $category;

        return $this;
    }

    public function subCategory(string $sub_category)
    {
        $this->request_array['SubCategory'] = $sub_category;

        return $this;
    }

    public function status(string $status)
    {
        $this->request_array['Status'] = $status;

        return $this;
    }

    public function connectedTo(string $connected_to)
    {
        $this->request_array['ConnectedTo'] = $connected_to;

        return $this;
    }

    public function connectionType(string $connected_type)
    {
        $this->request_array['ConnectionType'] = $connected_type;

        return $this;
    }

    public function enteredByID(int $enteredByID)
    {
        $this->request_array['EnteredByID'] = $enteredByID;

        return $this;
    }
}