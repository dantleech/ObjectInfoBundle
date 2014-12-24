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
use Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection\Configuration;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionConfigurationTestCase;

class ConfigurationTest extends AbstractExtensionConfigurationTestCase
{
    protected function getContainerExtension()
    {
        return new CmfObjectInfoExtension();
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }

    public function provideConfig()
    {
        return array(
            array(__DIR__ . '/fixtures/config.xml'),
            array(__DIR__ . '/fixtures/config.yml'),
        );
    }

    /**
     * @dataProvider provideConfig
     */
    public function testConfig($source)
    {
        $this->assertProcessedConfigurationEquals(array(
            'providers' => array('one', 'two', 'three'),
            'expressions' => array(
                'Foo\Bar\Baz' => array(
                    'label' => 'label',
                    'route' => 'route', 
                ),
            ),
        ), array($source));
    }
}
