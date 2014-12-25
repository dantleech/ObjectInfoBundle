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
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Daniel Leech <daniel@dantleech.com>
 */
class ProviderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(
            'cmf_object_info.provider.aggregate'
        )) {
            return;
        }

        $aggregateProviderDef = $container->getDefinition(
            'cmf_object_info.provider.aggregate'
        );

        $wantedProviders = $container->getParameter('cmf_object_info.providers');

        $ids = $container->findTaggedServiceIds('cmf_object_info.provider');
        $providers = array();

        foreach ($ids as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \InvalidArgumentException(sprintf(
                    'No "alias" attribute specified for provider service definition: "%s"',
                    $id
                ));
            }

            $alias = $attributes[0]['alias'];

            if (isset($providers[$alias])) {
                throw new \InvalidArgumentException(sprintf(
                    'A provider has already been registered with alias "%s". It has the ID "%s"',
                    $alias, $id
                ));
            }

            $providers[$alias] = $id;
        }

        $resolvedProviders = array();
        foreach ($wantedProviders as $wantedProvider) {

            if (!isset($providers[$wantedProvider])) {
                throw new \InvalidArgumentException(sprintf(
                    'Provider "%s" has not been registered. Available providers are: "%s"',
                    $wantedProvider, implode('", "', $providers)
                ));
            }

            $resolvedProviders[] = new Reference($providers[$wantedProvider]);
        }

            $aggregateProviderDef->replaceArgument(
                0,
                $resolvedProviders
            );
    }
}
