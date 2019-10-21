<?php namespace Fopio\AffinityAPI\Requests\Products;

use Carbon\Carbon;
use Fopio\AffinityAPI\Requests\AbstractRequest;
use Fopio\AffinityAPI\Requests\AbstractRequestInterface;

class ProductInstanceUpdateRequest extends AbstractRequest implements AbstractRequestInterface
{
    protected $request_array = [];

    protected $required_fields = [];

    public function __construct()
    {
        $this->request_array['SiteID'] = null;
        $this->request_array['CLIID'] = null;
        $this->request_array['ProductItemID'] = null;
        $this->request_array['Quantity'] = null;
        $this->request_array['StartDate'] = null;
    }

    public function siteID(int $site_id)
    {
        $this->request_array['SiteID'] = $site_id;

        return $this;
    }

    public function cliID(int $cliID)
    {
        $this->request_array['CLIID'] = $cliID;

        return $this;
    }

    public function product_item_id(int $product_item_id)
    {
        $this->request_array['ProductItemID'] = $product_item_id;

        return $this;
    }

    public function quantity(int $quantity)
    {
        $this->request_array['Quantity'] = $quantity;

        return $this;
    }

    public function start_date(Carbon $start_date)
    {
        $this->request_array['StartDate'] = $start_date->toW3cString();

        return $this;
    }

    public function product_instance_id(int $product_instance_id)
    {
        $this->request_array['ProductInstanceID'] = $product_instance_id;

        return $this;
    }
}