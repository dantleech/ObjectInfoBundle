<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\ObjectInfo\Metadata;

class ObjectInfoMetadata extends ClassMetadata
{
    public $expressionMapping;

    public function setExpressionMapping($expressionMapping)
    {
        $this->expressionMapping = $expressionMapping;
    }
}
