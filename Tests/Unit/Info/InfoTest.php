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
        $this->info->set('foo', 'bar');
        $this->assertEquals('bar', $this->info->get('foo'));
    }

    public function testGetNonExisting()
    {
        $res = $this->info->get('non-existing');
        $this->assertNull($res);
    }
}
