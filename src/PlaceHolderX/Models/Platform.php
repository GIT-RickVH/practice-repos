<?php

namespace PlaceHolderX\Models;

class Platform
{
    /**
     * @var string
     */
    private $name;

    /**
     * Platform constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}