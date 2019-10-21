<?php namespace Fopio\AffinityAPI\Requests\Sites;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class SiteUpdateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array;

    protected $required_fields = ['CycleID'];

    public function __construct()
    {
        $this->request_array['CycleID'] = 0;
    }

    public function cycle_id(int $cycle_id)
    {
        $this->request_array['CycleID'] = $cycle_id;

        return $this;
    }
}