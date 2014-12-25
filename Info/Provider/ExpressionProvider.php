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

        $mappings = $this->getClassMappings($className);

        return $this->mapInfo($object, $mappings);
    }

    private function mapInfo($object, $mappings)
    {
        $info = new Info();

        foreach ($mappings as $mapping) {
            foreach ($mapping as $key => $expression) {
                $value = $this->expressionLanguage->evaluate($expression, array(
                    'object' => $object
                ));

                $info->offsetSet($key, $value);
            }
        }

        return $info;
    }

    private function getClassMappings($className)
    {
        $mappings = array();

        $classHierarchy = array_reverse(class_parents($className));
        $classHierarchy += array($className);

        foreach ($classHierarchy as $class) {
            if (isset($this->mapping[$class])) {
                $mappings[] = $this->mapping[$class];
            }
        }

        if ($mappings) {
            return $mappings;
        }

        throw new \InvalidArgumentException(sprintf(
            'Object of class "%s" is not mapped',
            $className
        ));
    }
}
