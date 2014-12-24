<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    /**
     * Returns the config tree builder.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('cmf_object_info')
            ->addDefaultsIfNotSet()
            ->fixXmlConfig('provider', 'providers')
            ->fixXmlConfig('expression', 'expressions')
            ->children()
                ->arrayNode('providers')
                    ->prototype('scalar')->isRequired()->end()
                ->end()
                ->arrayNode('expressions')
                    ->defaultValue(array())
                    ->useAttributeAsKey('fqcn')
                    ->prototype('array')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
