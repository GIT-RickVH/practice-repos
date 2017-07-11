<?php

namespace PlaceHolderX\Comparators;

use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Platform;

class GameComparator
{

    /**
     * @param Game $gameA
     * @param Game $gameB
     * @return bool
     */
    public static function equals(Game $gameA, Game $gameB)
    {
        return $gameA->getName() == $gameB->getName() && PlatformComparator::equals($gameA->getPlatform(), $gameB->getPlatform());
    }

    /**
     * @param Game $game
     * @param string $name
     * @param Platform $platform
     * @return bool
     */
    public static function equalsNameAndPlatform(Game $game, $name, Platform $platform)
    {
        return $game->getName() == $name && PlatformComparator::equals($game->getPlatform(), $platform);
    }

}