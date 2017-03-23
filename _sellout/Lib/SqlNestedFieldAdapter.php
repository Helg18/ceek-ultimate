<?php

namespace Sellout;

/**
 * Library to handle encoding and decoding of definition datum.
 */

class SqlNestedFieldAdapter
{
    protected $data;

    public function __construct($data = false)
    {
        $type = gettype($data);
        if(is_array($data))
        {
            $this->data = json_encode($data);
        }
        elseif(is_string($data) && is_array(json_decode($data, true)) && (json_last_error() == JSON_ERROR_NONE))
        {
            $this->data = json_decode($data, true);
        }
        else
        {
            if($data) throw new \Exception("Unexpected Data Type", 1);
        }
        $this->data = $data;
    }
    public function toJson($data = false)
    {
        return $this->toString($data);
    }
    public function toString($data = false)
    {
        return $this->_hasNoData($data)
            ? null
            : ($this->data)
                ? json_encode($this->data)
                : json_encode($data);
    }
    public function toArray($data = false)
    {
        return $this->_hasNoData($data)
            ? null
            : ($this->data)
                ? json_decode($this->data, true)
                : json_decode($data, true);
    }
    public function toObject($data = false)
    {
        return $this->_hasNoData($data)
            ? null
            : ($this->data)
                ? json_decode($this->data)
                : json_decode($data);
    }
    private function _hasNoData($data)
    {
        if($data === false && $this->data === false) return true;
        return false;
    }
}
