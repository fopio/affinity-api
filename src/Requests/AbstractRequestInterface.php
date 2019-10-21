<?php namespace Fopio\AffinityAPI\Requests;

use Carbon\Carbon;

interface AbstractRequestInterface
{
    public function getRequestArray();

    public function isValid();

    public function getErrors();
}