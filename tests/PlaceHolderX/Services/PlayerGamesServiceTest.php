<?php

namespace Tests\PlaceHolderX\Services;

use PlaceHolderX\Exceptions\PlayerHasGameException;
use PlaceHolderX\Factories\GameFactory;
use PlaceHolderX\Factories\PlatformFactory;
use PlaceHolderX\Factories\PlayerFactory;
use PlaceHolderX\Repositories\Memory\MemoryPlayerGamesRepository;
use PlaceHolderX\Services\PlayerGamesService;

class PlayerGamesServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function canAddGameToPlayer()
    {
        $player = PlayerFactory::create('PlayerA');
        $game = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $service = new PlayerGamesService(new MemoryPlayerGamesRepository());

        $hasBefore = $service->hasGame($game, $player);
        $service->addGameToPlayer(GameFactory::create('DifferentGame', PlatformFactory::create('PC')), $player);
        $hasBetween = $service->hasGame($game, $player);
        $service->addGameToPlayer($game, $player);
        $hasAfter = $service->hasGame($game, $player);
        $this->assertEquals([false, false, true], [$hasBefore, $hasBetween, $hasAfter]);
    }

    /**
     * @test
     */
    public function canNotAddDuplicateGameToPlayer()
    {
        $this->expectException(PlayerHasGameException::class);

        $player = PlayerFactory::create('PlayerA');
        $game = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $service = new PlayerGamesService(new MemoryPlayerGamesRepository());
        $service->addGameToPlayer($game, $player);
        $service->addGameToPlayer($game, $player);
    }

    /**
     * @test
     */
    public function canGetTheGamesForPlayer()
    {
        $player = PlayerFactory::create('PlayerA');
        $service = new PlayerGamesService(new MemoryPlayerGamesRepository());
        $service->addGameToPlayer(GameFactory::create('GameA', PlatformFactory::create('PC')), $player);
        $service->addGameToPlayer(GameFactory::create('GameB', PlatformFactory::create('PC')), $player);
        $service->addGameToPlayer(GameFactory::create('GameC', PlatformFactory::create('PC')), PlayerFactory::create('PlayerB'));
        $service->addGameToPlayer(GameFactory::create('GameD', PlatformFactory::create('PC')), $player);

        $this->assertCount(3, $service->getGames($player));
    }

    /**
     * @test
     */
    public function getPlayersWithGame()
    {
        $gameA = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $service = new PlayerGamesService(new MemoryPlayerGamesRepository());
        $service->addGameToPlayer($gameA, PlayerFactory::create('PlayerA'));
        $service->addGameToPlayer($gameA, PlayerFactory::create('PlayerB'));
        $service->addGameToPlayer(GameFactory::create('GameC', PlatformFactory::create('PC')), PlayerFactory::create('PlayerC'));
        $service->addGameToPlayer($gameA, PlayerFactory::create('PlayerD'));

        $this->assertCount(3, $service->getPlayers($gameA));
    }

    /**
     * @test
     */
    public function canRemoveGameFromPlayer()
    {
        $gameA = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $playerA = PlayerFactory::create('PlayerA');
        $service = new PlayerGamesService(new MemoryPlayerGamesRepository());
        $service->addGameToPlayer($gameA, $playerA);

        $hasBefore = $service->hasGame($gameA, $playerA);
        $service->removeGameFromPlayer($gameA, $playerA);
        $hasAfter = $service->hasGame($gameA, $playerA);
        $this->assertEquals([true, false], [$hasBefore, $hasAfter]);
    }

    /**
     * @test
     */
    public function canRemoveAGameFromPlayerWithoutHavingIt()
    {
        $gameA = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $playerA = PlayerFactory::create('PlayerA');
        $service = new PlayerGamesService(new MemoryPlayerGamesRepository());
        $service->removeGameFromPlayer($gameA, $playerA);
        $this->assertFalse($service->hasGame($gameA, $playerA));
    }

}