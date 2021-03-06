<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Unit\ObjectInfo;

use Prophecy\PhpUnit\ProphecyTestCase;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info;

class InfoManagerTest extends ProphecyTestCase
{
    private $info;

    public function setUp()
    {
        parent::setUp();
        $this->info = new Info();
    }

    public function testGetSet()
    {
        $this->info['foo'] = 'bar';
        $this->assertEquals('bar', $this->info['foo']);
    }

    public function testGetNonExisting()
    {
        $res = $this->info['non-existing'];
        $this->assertNull($res);
    }
}
