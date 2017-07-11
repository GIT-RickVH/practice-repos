<?php

namespace PlaceHolderX\Services;

use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Player;
use PlaceHolderX\Repositories\PlayerGamesRepository;

class PlayerGamesService
{
    /**
     * @var PlayerGamesRepository
     */
    private $playerGameRepository;

    /**
     * PlayerGamesService constructor.
     * @param PlayerGamesRepository $playerGameRepository
     */
    public function __construct(PlayerGamesRepository $playerGameRepository)
    {
        $this->playerGameRepository = $playerGameRepository;
    }

    /**
     * @param Game $game
     * @param Player $player
     */
    public function addGameToPlayer(Game $game, Player $player)
    {
        $this->playerGameRepository->addGameToPlayer($game, $player);
    }

    /**
     * @param Game $game
     * @param Player $player
     * @return bool
     */
    public function hasGame(Game $game, Player $player)
    {
        return $this->playerGameRepository->hasGame($game, $player);
    }

    /**
     * @param Player $player
     * @return Game[]
     */
    public function getGames(Player $player)
    {
        return $this->playerGameRepository->getGames($player);
    }

    /**
     * @param Game $game
     * @return Player[]
     */
    public function getPlayers(Game $game)
    {
        return $this->playerGameRepository->getPlayers($game);
    }

    /**
     * @param Game $game
     * @param Player $player
     */
    public function removeGameFromPlayer(Game $game, Player $player)
    {
        $this->playerGameRepository->removeGameFromPlayer($game, $player);
    }

}