<?php

namespace Tests\PlaceHolderX\Services;

use PlaceHolderX\Comparators\PlayerComparator;
use PlaceHolderX\Events\Notification\GameEvent;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Player;
use PlaceHolderX\Observers\NotificationObserver;
use PlaceHolderX\Services\PlayerGamesService;

class NotificationService
{
    /**
     * @var NotificationObserver
     */
    private $notificationObserver;

    /**
     * @var PlayerGamesService
     */
    private $playerGameService;

    /**
     * NotificationService constructor.
     * @param NotificationObserver $notificationObserver
     * @param PlayerGamesService $playerGamesService
     */
    public function __construct(NotificationObserver $notificationObserver, $playerGamesService)
    {
        $this->notificationObserver = $notificationObserver;
        $this->playerGameService = $playerGamesService;
    }

    /**
     * @param Game $game
     * @param Player $notifier
     * @return Player[]
     */
    public function notifyPlayersWithGame(Game $game, Player $notifier)
    {
        $playersWithGame = $this->removeNotifierFromPlayerList($notifier, $this->playerGameService->getPlayers($game));

        $this->notificationObserver->dispatch(new GameEvent($game, $playersWithGame));

        return $playersWithGame;
    }

    /**
     * @param Player $notifier
     * @param Player[] $playerList
     * @return Player[]
     */
    private function removeNotifierFromPlayerList(Player $notifier, $playerList)
    {
        foreach ($playerList as $key => $player) {
            if (PlayerComparator::equals($notifier, $player)) {
                array_splice($playerList, $key, 1);
                break;
            }
        }

        return $playerList;
    }

}