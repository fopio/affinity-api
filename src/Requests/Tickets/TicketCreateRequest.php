<?php namespace Fopio\AffinityAPI\Requests\Tickets;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class TicketCreateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array;

    protected $required_fields = ['Summary', 'Details', 'Priority', 'DateDue', 'OwnerID', 'TeamID', 'Category', 'ConnectedTo', 'ConnectionType'];

    public function __construct()
    {
        $this->request_array['Summary'] = null;
        $this->request_array['Details'] = null;
        $this->request_array['Priority'] = null;
        $this->request_array['DateDue'] = null;
        $this->request_array['OwnerID'] = null;
        $this->request_array['TeamID'] = null;
        $this->request_array['Category'] = null;
        $this->request_array['SubCategory'] = null;
        $this->request_array['Status'] = 'Reported';
        $this->request_array['ConnectedTo'] = null;
        $this->request_array['ConnectionType'] = null;
        $this->request_array['EnteredByID'] = 1;
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
}