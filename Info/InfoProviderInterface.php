<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Info;

interface InfoProviderInterface
{
    /**
     * Provide information for the object
     *
     * @return Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info
     */
    public function provideInfoFor($object);
}

