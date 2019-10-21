<?php namespace Fopio\AffinityAPI\API;

/**
 * Class Ordering
 * @package App\Packages\Affinity
 */
class Ordering
{
    protected $ordering = '<Ordering><Fields>';


    public function create():Ordering
    {
        $this->ordering = '<Ordering><Fields>';

        return $this;
    }

    public function field(string $field, string $direction): Ordering
    {
        $xml_string = '<Field><Name>' . $field . '</Name><Direction>' . ucwords($direction) . '</Direction></Field>';

        $this->ordering .= $xml_string;

        return $this;
    }

    /**
     * Get the final ordering XML
     * @return string
     */
    public function getOrderingXML(): string
    {
        return $this->ordering . '</Fields></Ordering>';
    }
}