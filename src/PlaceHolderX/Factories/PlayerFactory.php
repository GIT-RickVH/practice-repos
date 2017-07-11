<?php

namespace PlaceHolderX\Factories;

use PlaceHolderX\Models\Player;

class PlayerFactory
{

    /**
     * @param string $username
     * @return Player
     */
    public static function create($username)
    {
        return new Player($username);
    }

}