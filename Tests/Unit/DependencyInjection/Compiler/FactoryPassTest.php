<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Unit\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection\Compiler\FactoryPass;
use Symfony\Component\DependencyInjection\Definition;

class FactoryPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FactoryPass());
    }

    public function testCompilerPass()
    {
        $factoryDefinition = new Definition();
        $factoryDefinition->setArguments(array(
            new Definition(),
            array()
        ));
        $this->setDefinition('cmf_objectMeta.factory.container', $factoryDefinition);

        $repositoryDefinition = new Definition();
        $repositoryDefinition->addTag('cmf_objectMeta.repository', array('name' => 'test_repository'));
        $this->setDefinition('cmf_objectMeta.repository.test', $repositoryDefinition);

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            'cmf_objectMeta.factory.container',
            1,
            array(
                'test_repository' => 'cmf_objectMeta.repository.test'
            )
        );
    }
}
