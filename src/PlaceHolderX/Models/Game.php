<?php

namespace PlaceHolderX\Models;

class Game
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Platform
     */
    private $platform;

    /**
     * Game constructor.
     * @param string $name
     * @param Platform $platform
     */
    public function __construct($name, Platform $platform)
    {
        $this->name = $name;
        $this->platform = $platform;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Platform
     */
    public function getPlatform()
    {
        return $this->platform;
    }

}