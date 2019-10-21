<?php namespace Fopio\AffinityAPI\Requests;

use Carbon\Carbon;

abstract class AbstractRequest
{
    protected $required_fields = [];

    /**
     * Check to see if request is valid
     * @return bool
     */
    public function isValid()
    {
        foreach ($this->required_fields as $field) {
            if ($this->request_array[$field] == null) return false;
        }

        return true;
    }

    /**
     * get the errors if not valid
     * @return array
     */
    public function getErrors()
    {
        $errors = [];

        foreach ($this->required_fields as $field) {
            if ($this->request_array[$field] == null) $errors[] = 'Missing key field: ' . $field;
        }

        return $errors;
    }

    public function getRequestArray():array
    {
        return $this->request_array;
    }

    public function getField(string $field)
    {
        return $this->request_array[$field];
    }
}