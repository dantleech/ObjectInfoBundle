<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Provider;

use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\InfoProviderInterface;

class AggregateProvider implements InfoProviderInterface
{
    private $providers;

    public function __construct(array $providers = array())
    {
        $this->providers = $providers;
    }

    public function provideInfoFor($object)
    {
        $info = new Info();

        foreach ($this->providers as $provider) {
            $providerInfo = $provider->provideInfoFor($object);
            $info->merge($providerInfo);
        }

        return $info;
    }
}
