<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Unit\DependencyInjection;

use Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection\CmfObjectInfoExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

class CmfObjectInfoExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(new CmfObjectInfoExtension());
    }

    public function provideExtension()
    {
        return array(
            array(
                array(
                    'providers' => array('foo', 'bar'),
                    'expressions' => array(
                        'Foo\Bar\Foo' => array(
                            'label' => 'object.title',
                            'help' => 'This is some help',
                        ),
                    ),
                ),
            ),
            array(
                array(
                ),
            ),
        );
    }

    /**
     * @dataProvider provideExtension
     */
    public function testExtension($config)
    {
        $this->load($config);

        $config = array_merge(array(
            'providers' => array(),
            'expressions' => array(),
        ), $config);

        $driverDef = $this->container->getDefinition('cmf_object_info.provider.expression');
        $driverConfig = $driverDef->getArgument(1);

        $this->assertSame($config['expressions'], $driverConfig);
    }
}
