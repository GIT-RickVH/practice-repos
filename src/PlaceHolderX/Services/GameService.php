<?php

namespace PlaceHolderX\Services;

use PlaceHolderX\Exceptions\GameExistsException;
use PlaceHolderX\Exceptions\UnknownGameException;
use PlaceHolderX\Helpers\Repository\ListOptions;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Platform;
use PlaceHolderX\Repositories\GameRepository;

class GameService
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * GameService constructor.
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param Game $game
     * @throws GameExistsException When the game to save already exists
     */
    public function save(Game $game)
    {
        try {
            $existingGame = $this->findByNameAndPlatform($game->getName(), $game->getPlatform());
            throw new GameExistsException($existingGame);
        } catch (UnknownGameException $exception) {
            //No game like this exists, so it is ok to save
        }

        $this->gameRepository->save($game);
    }

    /**
     * @param Game $game
     * @return bool
     */
    public function has(Game $game)
    {
        return $this->gameRepository->has($game);
    }

    /**
     * @param string $name
     * @param Platform $platform
     * @return Game
     */
    public function findByNameAndPlatform($name, Platform $platform)
    {
        return $this->gameRepository->findByNameAndPlatform($name, $platform);
    }

    /**
     * @param ListOptions $listOptions
     * @return Game[]
     */
    public function getList(ListOptions $listOptions)
    {
        return $this->gameRepository->getList($listOptions);
    }

}