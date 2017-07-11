<?php

namespace PlaceHolderX\Formatter;

use PlaceHolderX\Models\Game;

class ProductFormatter
{
    const FORMAT_TITLE = '%s - %s';

    /**
     * @param Game $game
     * @return string
     */
    public static function getTitle(Game $game)
    {
        return sprintf(self::FORMAT_TITLE, $game->getName(), $game->getPlatform()->getName());
    }

}