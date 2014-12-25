<?php

namespace Symfony\Cmf\Bundle\ObjectInfoBundle\Tests\Resources\TestBundle\Document;

abstract class AbstractArticle
{
    private $id;
    private $title;

    public function getId() 
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle() 
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
