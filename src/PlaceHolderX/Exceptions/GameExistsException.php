<?php

namespace PlaceHolderX\Exceptions;

use PlaceHolderX\Models\Game;

class GameExistsException extends \Exception
{
    const ERROR_MESSAGE = 'A game with the name "%s" already exists for platform "%s"';

    /**
     * GameExistsException constructor.
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $game->getName(), $game->getPlatform()->getName()));
    }

}