<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\ObjectInfo\Metadata;

use Metadata\Driver\DriverInterface;

class ExtensionConfigDriver implements DriverInterface
{
    private $expressionMapping;

    public function __construct($expressionMapping)
    {
        $this->expressionMapping = $expressionMapping;
    }

    /**
     * {@inheritDoc}
     */
    public function loadMetadataForClass(\ReflectionClass $class)
    {
        $meta = new ObjectInfoMetadata();

        if (!isset($this->expressionMapping[$class->getName()])) {
            return null;
        }

        $mapping = $this->expressionMapping[$class->getName()];
        $meta->setExpressionMapping($mapping);

        return $meta;
    }
}
