<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Provider;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\InfoProviderInterface;
use Symfony\Cmf\Bundle\ObjectInfoBundle\Info\Info;

class ExpressionProvider implements InfoProviderInterface
{
    private $mapping;
    private $expressionLanguage;

    public function __construct(
        ExpressionLanguage $expressionLanguage,
        $mapping
    )
    {
        $this->mapping = $mapping;
        $this->expressionLanguage = $expressionLanguage;
    }

    public function provideInfoFor($object)
    {
        $className = get_class($object);

        $mapping = $this->getClassMapping($className);

        return $this->mapInfo($object, $mapping);
    }

    private function mapInfo($object, $mapping)
    {
        $info = new Info();

        foreach ($mapping as $key => $expression) {
            $value = $this->expressionLanguage->evaluate($expression, array(
                'object' => $object
            ));

            $info->set($key, $value);
        }

        return $info;
    }

    private function getClassMapping($className)
    {
        if (isset($this->mapping[$className])) {
            return $this->mapping[$className];
        }

        $classParents = array_reverse(class_parents($className));

        foreach ($classParents as $classParent) {
            if (isset($this->mapping[$classParent])) {
                return $classParent;
            }
        }

        throw new \InvalidArgumentException(sprintf(
            'Object of class "%s" is not mapped',
            $className
        ));
    }
}
