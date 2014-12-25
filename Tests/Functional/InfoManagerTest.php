<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Functional;

use Symfony\Cmf\Component\Testing\Functional\BaseTestCase;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Resources\TestBundle\Document\Article;

class InfoManagerTest extends BaseTestCase
{
    private $manager;

    public function setUp()
    {
        $this->provider = $this->getContainer()->get('cmf_object_info.provider');
    }

    public function provideProvider()
    {
        return array(
            // Concrete article has label mapped expcitly to "Conrete Article"
            array(
                'Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Resources\TestBundle\Document\Article',
                array(
                    'label' => 'Concrete Article',
                    'icon_16' => 'bundles/foobar.png',
                    'edit_route' => array('bar_edit', array('id' => 5)),
                    'view_route' => array('bar_view', array('id' => 5)),
                ),
            ),
            // BaseArticle inherits from AbstractArticle and maps label to object title
            array(
                'Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Resources\TestBundle\Document\BaseArticle',
                array(
                    'label' => 'Hello',
                    'icon_16' => 'bundles/foobar.png',
                    'edit_route' => array('bar_edit', array('id' => 5)),
                    'view_route' => array('bar_view', array('id' => 5)),
                ),
            ),
        );
    }

    /**
     * @dataProvider provideProvider
     */
    public function testProvider($class, $expectedInfo)
    {
        $article = new $class;
        $article->setTitle('Hello');
        $article->setId('5');

        $info = $this->provider->provideInfoFor($article);

        $this->assertEquals($expectedInfo, $info->toArray());
    }
}

