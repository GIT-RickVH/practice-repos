<?php

namespace PlaceHolderX\Factories;

use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Platform;

class GameFactory
{

    /**
     * @param string $name
     * @param Platform $platform
     * @return Game
     */
    public static function create($name, Platform $platform)
    {
        return new Game($name, $platform);
    }

}