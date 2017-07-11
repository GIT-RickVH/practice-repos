<?php

namespace PlaceHolderX\Services;

use PlaceHolderX\Models\Player;
use PlaceHolderX\Repositories\PlayerRepository;

class PlayerService
{
    /**
     * @var PlayerRepository
     */
    private $playerRepository;

    /**
     * PlayerService constructor.
     * @param PlayerRepository $playerRepository
     */
    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @param Player $player
     * @return bool
     */
    public function has(Player $player)
    {
        return $this->playerRepository->has($player);
    }

    /**
     * @param Player $player
     */
    public function add(Player $player)
    {
        $this->playerRepository->add($player);
    }

    /**
     * @param string $username
     * @return Player
     */
    public function findByUsername($username)
    {
        return $this->playerRepository->findByUsername($username);
    }

}