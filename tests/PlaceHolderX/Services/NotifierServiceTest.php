<?php

namespace Tests\PlaceHolderX\Services;

use PlaceHolderX\Comparators\GameComparator;
use PlaceHolderX\Comparators\PlayerComparator;
use PlaceHolderX\Events\Notification\GameEvent;
use PlaceHolderX\Events\Notification\NotificationEvent;
use PlaceHolderX\Factories\GameFactory;
use PlaceHolderX\Factories\PlatformFactory;
use PlaceHolderX\Factories\PlayerFactory;
use PlaceHolderX\Listeners\NotificationListener;
use PlaceHolderX\Repositories\Memory\MemoryPlayerGamesRepository;
use PlaceHolderX\Observers\NotificationObserver;
use PlaceHolderX\Services\PlayerGamesService;

class NotifierServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function canNotifyToPlayGame()
    {
        $gameA = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $playerA = PlayerFactory::create('PlayerA');
        $playerC = PlayerFactory::create('PlayerC');
        $notifier = PlayerFactory::create('Notifier');
        $playerGamesService = new PlayerGamesService(new MemoryPlayerGamesRepository([
            $playerA->getUsername()     => [$gameA],
            'PlayerB'                   => [GameFactory::create('GameB', PlatformFactory::create('PC'))],
            $playerC->getUsername()     => [GameFactory::create('GameB', PlatformFactory::create('PC')), $gameA],
            $notifier->getUsername()    => [$gameA],
        ]));

        $listenerIsCalled = false;
        /** @var \PHPUnit_Framework_MockObject_MockObject|NotificationListener $listener */
        $listener = $this->getMockBuilder(NotificationListener::class)->setMethods(['notify'])->getMock();
        $listener->method('notify')->willReturnCallback(function(NotificationEvent $event) use (&$listenerIsCalled, $gameA){
            if ($event instanceof GameEvent) {
                $listenerIsCalled = GameComparator::equals($gameA, $event->getGame()) && count($event->getPlayers()) === 2;
            }
        });

        $observer = new NotificationObserver();
        $observer->addListener($listener);

        $service = new NotificationService($observer, $playerGamesService);
        $playersToNotify = $service->notifyPlayersWithGame($gameA, $notifier);

        $containsPlayerA = false;
        $containsPlayerC = false;
        foreach ($playersToNotify as $player) {
            if (PlayerComparator::equals($playerA, $player)) {
                $containsPlayerA = true;
            }
            else if (PlayerComparator::equals($playerC, $player)) {
                $containsPlayerC = true;
            }
        }

        $this->assertEquals([2, true, true, true], [count($playersToNotify), $containsPlayerA, $containsPlayerC, $listenerIsCalled]);
    }

}
