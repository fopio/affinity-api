<?php namespace Fopio\AffinityAPI\Requests\Payments;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class PaymentUpdateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array = [];

    protected $required_fields = ['SiteID', 'paymentMethod', 'paymentTerms', 'bankAccountReference', 'bankAccountNumber', 'bankAccountSortCode', 'ddReference'];

    public function __construct()
    {
        $this->request_array['SiteID'] = null;
        $this->request_array['paymentMethod'] = null;
        $this->request_array['paymentTerms'] = null;
        $this->request_array['bankAccountReference'] = null;
        $this->request_array['bankAccountNumber'] = null;
        $this->request_array['bankAccountSortCode'] = null;
        $this->request_array['ddReference'] = null;
    }

    public function siteID(int $site_id)
    {
        $this->request_array['SiteID'] = $site_id;

        return $this;
    }

    public function payment_method(string $payment_method)
    {
        $this->request_array['paymentMethod'] = $payment_method;

        return $this;
    }

    public function terms(int $address2)
    {
        $this->request_array['paymentTerms'] = $address2;

        return $this;
    }

    public function account_reference(int $account_reference)
    {
        $this->request_array['bankAccountReference'] = $account_reference;

        return $this;
    }

    public function account_number(string $account_number)
    {
        $this->request_array['bankAccountNumber'] = $account_number;

        return $this;
    }

    public function sort_code(string $sort_code)
    {
        $this->request_array['bankAccountSortCode'] = $sort_code;

        return $this;
    }

    public function direct_debit_reference(string $direct_debit_reference)
    {
        $this->request_array['ddReference'] = $direct_debit_reference;

        return $this;
    }
}