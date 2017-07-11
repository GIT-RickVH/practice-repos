<?php

namespace Tests\PlaceHolderX\Services;

use PlaceHolderX\Comparators\PlayerComparator;
use PlaceHolderX\Exceptions\PlayerExistsException;
use PlaceHolderX\Exceptions\UnknownPlayerException;
use PlaceHolderX\Factories\PlayerFactory;
use PlaceHolderX\Repositories\Memory\MemoryPlayerRepository;
use PlaceHolderX\Services\PlayerService;

class PlayerServiceTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @test
	 */
	public function canAddPlayer()
	{
		$player = PlayerFactory::create('PlayerA');
		$service = new PlayerService(new MemoryPlayerRepository());
		$this->assertEquals([false, null, true], [$service->has($player), $service->add($player), $service->has($player)]);
	}

	/**
	 * @test
	 */
	public function canNotAddDuplicatePlayer()
	{
		$this->expectException(PlayerExistsException::class);

		$player = PlayerFactory::create('PlayerA');
		$service = new PlayerService(new MemoryPlayerRepository([$player]));
		$service->add($player);
	}

	/**
	 * @test
	 */
	public function canFindPlayer()
	{
		$existingPlayer = PlayerFactory::create('PlayerName');
		$service = new PlayerService(new MemoryPlayerRepository([$existingPlayer]));
		$foundPlayer = $service->findByUsername($existingPlayer->getUsername());
		$this->assertTrue(PlayerComparator::equals($existingPlayer, $foundPlayer));
	}

	/**
	 * @test
	 */
	public function throwsExceptionWhenPlayerNotFound()
	{
		$this->expectException(UnknownPlayerException::class);

		$service = new PlayerService(new MemoryPlayerRepository());
		$service->findByUsername('Nobody');
	}

}