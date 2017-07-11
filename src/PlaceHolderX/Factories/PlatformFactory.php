<?php

namespace PlaceHolderX\Factories;

use PlaceHolderX\Models\Platform;

class PlatformFactory
{

    /**
     * @param string $name
     * @return Platform
     */
    public static function create($name)
    {
        return new Platform($name);
    }

}