<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * @author Daniel Leech <daniel@dantleech.com>
 */
class ProviderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(
            'cmf_object_info.manager'
        )) {
            return;
        }

        $managerDef = $container->getDefinition(
            'cmf_object_info.manager'
        );

        $ids = $container->findTaggedServiceIds('cmf_object_info.provider');

        foreach ($ids as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \InvalidArgumentException(sprintf(
                    'No "alias" attribute specified for provider service definition: "%s"',
                    $id
                ));
            }

            $repositoryFactory->addMethodCall(
                'addProvider',
                array($attributes[0]['alias'], new Reference($id))
            );
        }
    }
}
