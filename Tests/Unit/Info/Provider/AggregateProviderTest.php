<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Unit\Info\Provider;

use Prophecy\PhpUnit\ProphecyTestCase;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Provider\AggregateProvider;

class AggregateProviderTest extends ProphecyTestCase
{
    private $provider1;
    private $info;
    private $object;

    public function setUp()
    {
        parent::setUp();
        $this->provider1 = $this->prophesize('Symfony\Cmf\Bundle\ObjectInfoBundle\Info\InfoProviderInterface');
        $this->info = $this->prophesize('Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info');
        $this->object = new \stdClass();
    }

    private function createAggregateProvider(array $providers = array())
    {
        return new AggregateProvider($providers);
    }

    public function testManager()
    {
        $aggregateProvider = $this->createAggregateProvider(array(
            $this->provider1->reveal()
        ));

        $this->info->toArray()->willReturn(array());
        $this->provider1->provideInfoFor($this->object)->willReturn($this->info->reveal());

        $info = $aggregateProvider->provideInfoFor($this->object);
        $this->assertInstanceOf('Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info', $info);
    }
}

