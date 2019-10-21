<?php namespace Fopio\AffinityAPI\Requests\Addresses;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class AddressUpdateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array = [];

    protected $required_fields = ['SiteID', 'AddressType'];

    public function __construct()
    {
        $this->request_array['SiteID'] = null;
        $this->request_array['Address1'] = null;
        $this->request_array['Address2'] = null;
        $this->request_array['Address3'] = null;
        $this->request_array['Town'] = null;
        $this->request_array['County'] = null;
        $this->request_array['PostCode'] = null;
        $this->request_array['AddressType'] = null;
    }

    public function siteID(int $site_id)
    {
        $this->request_array['SiteID'] = $site_id;

        return $this;
    }

    public function address1(string $address1)
    {
        $this->request_array['Address1'] = $address1;

        return $this;
    }

    public function address2(int $address2)
    {
        $this->request_array['Address2'] = $address2;

        return $this;
    }

    public function address3(int $address3)
    {
        $this->request_array['Address3'] = $address3;

        return $this;
    }

    public function town(string $town)
    {
        $this->request_array['Town'] = $town;

        return $this;
    }

    public function county(string $county)
    {
        $this->request_array['County'] = $county;

        return $this;
    }

    public function postcode(string $postcode)
    {
        $this->request_array['PostCode'] = $postcode;

        return $this;
    }

    public function address_type(string $address_type)
    {
        $this->request_array['AddressType'] = $address_type;

        return $this;
    }
}