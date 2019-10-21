<?php namespace Fopio\AffinityAPI\API;

/**
 * Class Projection
 * @package App\Packages\Affinity
 */
class Projection
{
    protected $projection = '<Projection>';

    public function create():Projection
    {
        $this->projection = '<Projection>';

        return $this;
    }

    /**
     * Get the final projection XML
     * @return string
     */
    public function getProjectionXML(): string
    {
        return $this->projection . '</Projection>';
    }
}