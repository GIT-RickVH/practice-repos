<?php

namespace PlaceHolderX\Repositories\Memory;

use PlaceHolderX\Comparators\GameComparator;
use PlaceHolderX\Exceptions\PlayerHasGameException;
use PlaceHolderX\Factories\PlayerFactory;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Player;
use PlaceHolderX\Repositories\PlayerGamesRepository;

class MemoryPlayerGamesRepository extends AbstractMemoryRepository implements PlayerGamesRepository
{

    /**
     * @param Game $game
     * @param Player $player
     * @throws PlayerHasGameException When the player already has the game
     */
    public function addGameToPlayer(Game $game, Player $player)
    {
        if ($this->hasGame($game, $player)) {
            throw new PlayerHasGameException($player, $game);
        }

        if (!isset($this->items[$player->getUsername()])) {
            $this->items[$player->getUsername()] = [];
        }

        $this->items[$player->getUsername()][] = $game;
    }

    /**
     * @param Game $game
     * @param Player $player
     * @return bool
     */
    public function hasGame(Game $game, Player $player)
    {
        if (!isset($this->items[$player->getUsername()])) {
            return false;
        }

        foreach ($this->items[$player->getUsername()] as $playerGame) {
            if (GameComparator::equals($playerGame, $game)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Player $player
     * @return Game[]
     */
    public function getGames(Player $player)
    {
        return (isset($this->items[$player-> getUsername()])) ? $this->items[$player-> getUsername()] : [];
    }

    /**
     * @param Game $game
     * @return Player[]
     */
    public function getPlayers(Game $game)
    {
        $players = [];

        foreach ($this->items as $username => $games) {
            $player = PlayerFactory::create($username);
            if ($this->hasGame($game, $player)) {
                $players[] = $player;
            }
        }

        return $players;
    }

    /**
     * @param Game $game
     * @param Player $player
     */
    public function removeGameFromPlayer($game, $player)
    {
        if (!isset($this->items[$player->getUsername()])) {
            return;
        }

        foreach ($this->items[$player->getUsername()] as $key => $playerGame) {
            if (GameComparator::equals($playerGame, $game)) {
                array_splice($this->items[$player->getUsername()], $key, 1);
                break;
            }
        }
    }
}