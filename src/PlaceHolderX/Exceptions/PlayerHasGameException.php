<?php

namespace PlaceHolderX\Exceptions;

use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Player;

class PlayerHasGameException extends \Exception
{
    const ERROR_MESSAGE = 'Player "%s" already has game "%s" on platform "%s".';

    /**
     * PlayerHasGameException constructor.
     * @param Player $player
     * @param Game $game
     */
    public function __construct(Player $player, Game $game)
    {
        parent::__construct(sprintf(sprintf(self::ERROR_MESSAGE, $player->getUsername(), $game->getName(), $game->getPlatform()->getName())));
    }

}