<?php namespace Fopio\AffinityAPI\Requests\Contacts;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class ContactCreateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array = [];

    protected $required_fields = ['Title', 'FirstName', 'LastName', 'EmailAddress', 'Mobile', 'WorkPhone'];

    public function __construct()
    {
        $this->request_array['Title'] = null;
        $this->request_array['FirstName'] = null;
        $this->request_array['LastName'] = null;
        $this->request_array['EmailAddress'] = null;
        $this->request_array['Mobile'] = null;
        $this->request_array['WorkPhone'] = null;
    }

    public function title(int $title)
    {
        $this->request_array['Title'] = $title;

        return $this;
    }

    public function firstname(string $firstname)
    {
        $this->request_array['FirstName'] = $firstname;

        return $this;
    }

    public function lastname(string $lastname)
    {
        $this->request_array['LastName'] = $lastname;

        return $this;
    }

    public function email_address(string $email_address)
    {
        $this->request_array['EmailAddress'] = $email_address;

        return $this;
    }

    public function mobile(string $mobile)
    {
        $this->request_array['Mobile'] = $mobile;

        return $this;
    }

    public function work_phone(string $work_phone)
    {
        $this->request_array['WorkPhone'] = $work_phone;

        return $this;
    }
}