<?php

namespace PlaceHolderX\Repositories\Memory;

use PlaceHolderX\Comparators\PlayerComparator;
use PlaceHolderX\Exceptions\PlayerExistsException;
use PlaceHolderX\Exceptions\UnknownPlayerException;
use PlaceHolderX\Factories\PlayerFactory;
use PlaceHolderX\Models\Player;
use PlaceHolderX\Repositories\PlayerRepository;

class MemoryPlayerRepository extends AbstractMemoryRepository implements PlayerRepository
{

    /**
     * Checks of the player exists
     * @param Player $player
     * @return bool
     */
    public function has(Player $player)
    {
        foreach ($this->items as $existingPlayer) {
            if (PlayerComparator::equals($player, $existingPlayer) === true) {
                return true;
            }
        }

        return false;
    }

    /**
     * Adds the given player
     * @param Player $player
     * @throws PlayerExistsException When the given player already exists
     */
    public function add(Player $player)
    {
        if ($this->has($player)) {
            throw new PlayerExistsException($player->getUsername());
        }

        $this->items[] = $player;
    }

    /**
     * Finds the user by the given username
     * @param string $username
     * @return Player
     * @throws UnknownPlayerException
     */
    public function findByUsername($username)
    {
        /** @var Player $player */
        foreach ($this->items as $player) {
            if ($player->getUsername() == $username) {
                return PlayerFactory::create($player->getUsername());
            }
        }

        throw new UnknownPlayerException($username);
    }
}