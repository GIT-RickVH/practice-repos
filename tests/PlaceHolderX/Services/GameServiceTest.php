<?php

namespace Tests\PlaceHolderX\Services;

use PlaceHolderX\Exceptions\GameExistsException;
use PlaceHolderX\Exceptions\UnknownGameException;
use PlaceHolderX\Factories\GameFactory;
use PlaceHolderX\Factories\PlatformFactory;
use PlaceHolderX\Formatter\ProductFormatter;
use PlaceHolderX\Helpers\Repository\LimitOptions;
use PlaceHolderX\Helpers\Repository\SortOptions\GameSortOptions;
use PlaceHolderX\Helpers\Repository\ListOptions;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Repositories\Memory\MemoryGameRepository;
use PlaceHolderX\Services\GameService;

class GameServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function canSaveGame()
    {
        $game = GameFactory::create('GameA', PlatformFactory::create('PC'));
        $gameService = new GameService(new MemoryGameRepository());
        $gameService->save($game);

        $this->assertTrue($gameService->has($game));
    }

    /**
     * @test
     */
    public function returnFalseOnNonExistingGame()
    {
        $gameService = new GameService(new MemoryGameRepository());
        $this->assertFalse($gameService->has(GameFactory::create('GameA', PlatformFactory::create('PC'))));
    }

    /**
     * @test
     */
    public function canGetGame()
    {
        $gameService = new GameService(new MemoryGameRepository([
            GameFactory::create('GameA', PlatformFactory::create('PC'))
        ]));

        $this->assertInstanceOf(Game::class, $gameService->findByNameAndPlatform('GameA', PlatformFactory::create('PC')));
    }

    /**
     * @test
     */
    public function exceptionWhenGettingUnknownGame()
    {
        $this->expectException(UnknownGameException::class);
        $gameService = new GameService(new MemoryGameRepository());
        $gameService->findByNameAndPlatform('GameA', PlatformFactory::create('PC'));
    }

    /**
     * @test
     */
    public function canNotAddDuplicateGame()
    {
        $this->expectException(GameExistsException::class);
        $gameService = new GameService(new MemoryGameRepository([GameFactory::create('GameA', PlatformFactory::create('PC'))]));
        $gameService->save(GameFactory::create('GameA', PlatformFactory::create('PC')));
    }

    /**
     * @test
     */
    public function canListGames()
    {
        $gameService = new GameService(new MemoryGameRepository([
            GameFactory::create('GameA', PlatformFactory::create('PC')),
            GameFactory::create('GameC', PlatformFactory::create('PC')),
            GameFactory::create('GameB', PlatformFactory::create('PC')),
        ]));

        $listedGames = $gameService->getList(ListOptions::create());
        $this->assertEquals(['GameA - PC', 'GameC - PC', 'GameB - PC'], array_map(function(Game $game){
            return ProductFormatter::getTitle($game);
        }, $listedGames));
    }

    /**
     * @test
     */
    public function canListSortedGames()
    {
        $gameService = new GameService(new MemoryGameRepository([
            GameFactory::create('GameA', PlatformFactory::create('PC')),
            GameFactory::create('GameC', PlatformFactory::create('PC')),
            GameFactory::create('GameB', PlatformFactory::create('PC')),
        ]));

        $listedGames = $gameService->getList(ListOptions::create()->setSortOptions(GameSortOptions::create(GameSortOptions::SORT_BY_GAME_NAME)));
        $this->assertEquals(['GameA - PC', 'GameB - PC', 'GameC - PC'], array_map(function(Game $game){
            return ProductFormatter::getTitle($game);
        }, $listedGames));
    }

    /**
     * @test
     */
    public function canGetLimitedList()
    {
        $gameService = new GameService(new MemoryGameRepository([
            GameFactory::create('GameA', PlatformFactory::create('PC')),
            GameFactory::create('GameC', PlatformFactory::create('PC')),
            GameFactory::create('GameB', PlatformFactory::create('PC')),
        ]));

        $listedGames = $gameService->getList(ListOptions::create()->setLimitOptions(LimitOptions::create(2, 1)));
        $this->assertEquals(['GameC - PC', 'GameB - PC'], array_map(function(Game $game){
            return ProductFormatter::getTitle($game);
        }, $listedGames));
    }


}