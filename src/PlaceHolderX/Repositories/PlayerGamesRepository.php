<?php

namespace PlaceHolderX\Repositories;

use PlaceHolderX\Exceptions\PlayerHasGameException;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Player;

interface PlayerGamesRepository
{

    /**
     * @param Game $game
     * @param Player $player
     * @throws PlayerHasGameException When the player already has the game
     */
    public function addGameToPlayer(Game $game, Player $player);

    /**
     * @param Game $game
     * @param Player $player
     * @return bool
     */
    public function hasGame(Game $game, Player $player);

    /**
     * @param Player $player
     * @return Game[]
     */
    public function getGames(Player $player);

    /**
     * @param Game $game
     * @return Player[]
     */
    public function getPlayers(Game $game);

    /**
     * @param Game $game
     * @param Player $player
     */
    public function removeGameFromPlayer($game, $player);

}