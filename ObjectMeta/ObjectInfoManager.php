<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\ObjectInfo;

class ObjectInformationManager
{
    protected $providers;

    public function getObjectInfodata($object)
    {
        $ObjectInformation = new ObjectInformation;
        foreach ($this->providers as $provider) {
            $provider->mergeInformation($ObjectInfo);
        }

        return $ObjectInformation;
    }
}
