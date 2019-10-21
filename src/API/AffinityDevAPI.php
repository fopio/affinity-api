<?php namespace Fopio\AffinityAPI\API;

/**
 * Class AffinityUserAPI
 * @package App\Packages\Affinity
 */
class AffinityDevAPI extends AffinityAPICore
{
    protected function dumpFunctions()
    {
        dd($this->client->__getFunctions());
    }

    protected function dumpTypes()
    {
        dd($this->client->__getTypes());
    }
}