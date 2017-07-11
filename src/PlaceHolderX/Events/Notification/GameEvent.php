<?php

namespace PlaceHolderX\Events\Notification;

use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Player;

class GameEvent implements NotificationEvent
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @var Player[]
     */
    private $players;

    /**
     * GameEvent constructor.
     * @param Game $game
     * @param Player[] $players
     */
    public function __construct(Game $game, array $players)
    {
        $this->game = $game;
        $this->players = $players;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

}