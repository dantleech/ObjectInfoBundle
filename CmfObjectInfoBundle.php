<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ObjectInfoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection\Compiler\FactoryPass;
use Symfony\Cmf\Bundle\ObjectInfoBundle\DependencyInjection\Compiler\CompositeRepositoryPass;

class CmfObjectInfoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new FactoryPass());
        $container->addCompilerPass(new CompositeRepositoryPass());
        parent::build($container);
    }

}
