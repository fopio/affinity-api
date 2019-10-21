<?php namespace Fopio\AffinityAPI\Requests\Contacts;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class SiteContactCreateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array = [];

    protected $required_fields = ['siteID', 'contactType', 'contactTitle', 'contactFirstName', 'contactLastName', 'contactTelephoneNumber', 'contactMobileNumber', 'contactEmailAddress'];

    public function __construct()
    {
        $this->request_array['siteID'] = null;
        $this->request_array['contactType'] = 'Site';
        $this->request_array['contactTitle'] = null;
        $this->request_array['contactFirstName'] = null;
        $this->request_array['contactLastName'] = null;
        $this->request_array['contactTelephoneNumber'] = null;
        $this->request_array['contactMobileNumber'] = null;
        $this->request_array['contactEmailAddress'] = null;
    }

    public function site_id(int $site_id)
    {
        $this->request_array['siteID'] = $site_id;

        return $this;
    }

    public function type(string $type)
    {
        $this->request_array['contactType'] = $type;

        return $this;
    }

    public function title(string $title)
    {
        $this->request_array['contactTitle'] = $title;

        return $this;
    }

    public function firstname(string $firstname)
    {
        $this->request_array['contactFirstName'] = $firstname;

        return $this;
    }

    public function lastname(string $lastname)
    {
        $this->request_array['contactLastName'] = $lastname;

        return $this;
    }

    public function email_address(string $email_address)
    {
        $this->request_array['contactEmailAddress'] = $email_address;

        return $this;
    }

    public function mobile(string $mobile)
    {
        $this->request_array['contactMobileNumber'] = $mobile;

        return $this;
    }

    public function telephone_phone(string $telephone_phone)
    {
        $this->request_array['contactTelephoneNumber'] = $telephone_phone;

        return $this;
    }
}