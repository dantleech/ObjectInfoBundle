<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Info;

use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info;

class Info extends \ArrayObject
{
    private $data = array();

    public function merge(Info $info)
    {
        foreach ($info->all() as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function all()
    {
        return $this->data;
    }

    public function get($key)
    {
        if (!isset($this->data[$key])) {
            return null;
        }

        return $this->data[$key];
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }
}
