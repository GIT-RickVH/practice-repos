<?php

namespace PlaceHolderX\Repositories;

use PlaceHolderX\Exceptions\PlayerExistsException;
use PlaceHolderX\Exceptions\UnknownPlayerException;
use PlaceHolderX\Models\Player;

interface PlayerRepository
{

    /**
     * Checks of the player exists
     * @param Player $player
     * @return bool
     */
    public function has(Player $player);

    /**
     * Adds the given player
     * @param Player $player
     * @throws PlayerExistsException When the given player already exists
     */
    public function add(Player $player);

    /**
     * Finds the user by the given username
     * @param string $username
     * @return Player
     * @throws UnknownPlayerException
     */
    public function findByUsername($username);

}