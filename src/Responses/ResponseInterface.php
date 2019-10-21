<?php namespace Fopio\AffinityAPI\Responses;

use Carbon\Carbon;

interface ResponseInterface
{
    public function setResponse(\stdClass $affinity_response);

    public function getResponse();
}