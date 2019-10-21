<?php namespace Fopio\AffinityAPI\Objects;

use Carbon\Carbon;
use Fopio\AffinityAPI\Responses\AbstractResponse;
use Fopio\AffinityAPI\Responses\AbstractResponseInterface;

interface AffinityObjectInterface
{
    public function setObject(\stdClass $affinity_response);

    public function getResponseAsArray(): array;

    public function getResponseAsObject(): \stdClass;

    public function getRawResponse(): \stdClass;
}