<?php namespace Fopio\AffinityAPI\API;

/**
 * Class Filter
 * @package App\Packages\Affinity
 */
class Filter
{
    protected $filter = '';

    protected $valid_group_types = ['NONE', 'OR', 'AND'];

    /**
     * Create a filter
     * @param string $type
     * @param string $name
     * @return Filter
     */
    public function create(string $type = 'NONE', string $name = 'Default'): Filter
    {
        $this->validateGroupType($type);

        $xml_string = '<Filter><Group type="' . $type . '" name="' . $name . '">';

        $this->filter .= $xml_string;

        return $this;
    }

    /**
     * Add a group to the filter
     * @param string $type
     * @param string $name
     * @return Filter
     */
    public function addGroup(string $type = 'NONE', string $name = 'Default'): Filter
    {
        $this->validateGroupType($type);

        $xml_string = '</Group><Group type="' . $type . '" name="' . $name . '">';

        $this->filter .= $xml_string;

        return $this;
    }

    /**
     * Add field to the current group
     * @param string $field
     * @param string $operator
     * @param $value
     * @return Filter
     */
    public function field(string $field, string $operator, $value): Filter
    {
        $xml_string = '<Field><Name>' . $field . '</Name><Operator>' . $this->convertOperator($operator) . '</Operator><Value>' . $value . '</Value></Field>';

        $this->filter .= $xml_string;

        return $this;
    }

    /**
     * Get the final filter
     * @return string
     */
    public function getFilterXML(): string
    {
        return $this->filter . '</Group></Filter>';
    }

    /**
     * Converts operator to affinity operator
     * @param string $operator
     * @return string
     * @throws \Exception
     */
    protected function convertOperator(string $operator):string
    {
        switch ($operator){
            case '=':
                return 'equalto';
                break;
            case '!=':
                return 'notequalto';
                break;
            case '>':
                return 'greaterthan';
                break;
            case '<':
                return 'lessthan';
                break;
            default:
                throw new \Exception('Unknown operator');
        }
    }

    /**
     * Validate the group type
     * @param string $type
     * @throws \Exception
     */
    protected function validateGroupType(string $type)
    {
        if(!in_array($type, $this->valid_group_types)) throw new \Exception('Not a valid group type, NONE, AND, OR');
    }
}