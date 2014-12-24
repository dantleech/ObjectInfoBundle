<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Unit\Info\Provider;

use Prophecy\PhpUnit\ProphecyTestCase;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Provider\ExpressionProvider;

class ExpressionProviderTest extends ProphecyTestCase
{
    private $expressionLanguage;

    public function setUp()
    {
        $this->expressionLanguage = $this->prophesize('Symfony\Component\ExpressionLanguage\ExpressionLanguage');
        $mapping = array(
            'stdClass' => array(
                'icon' => 'bah',
                'route' => 'boo',
            ),
        );

        $this->provider = new ExpressionProvider(
            $this->expressionLanguage->reveal(),
            $mapping
        );

        $this->object = new \stdClass;
    }

    public function testProvider()
    {
        $this->expressionLanguage->evaluate('bah', array('object' => $this->object))->willReturn('foo');
        $this->expressionLanguage->evaluate('boo', array('object' => $this->object))->willReturn('bar');

        $info = $this->provider->provideInfoFor($this->object);

        $this->assertInstanceOf('Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info', $info);

        $this->assertEquals('foo', $info->get('icon'));
        $this->assertEquals('bar', $info->get('route'));
    }
}
