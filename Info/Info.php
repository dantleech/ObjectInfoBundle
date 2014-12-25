<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Info;

use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info;

class Info extends \ArrayObject
{
    private $data = array();

    public function merge(Info $info)
    {
        foreach ($info->toArray() as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function toArray()
    {
        return $this->data;
    }

    public function offsetSet($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function offsetGet($key)
    {
        if (!isset($this->data[$key])) {
            return null;
        }

        $data = $this->data[$key];

        if (is_array($data)) {
            return new self($data);
        }

        return $data;
    }
}
