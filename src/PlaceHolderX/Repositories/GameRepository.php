<?php

namespace PlaceHolderX\Repositories;

use PlaceHolderX\Exceptions\UnknownGameException;
use PlaceHolderX\Helpers\Repository\ListOptions;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Platform;

interface GameRepository
{
    /**
     * @param Game $game
     */
    public function save(Game $game);

    /**
     * @param Game $game
     * @return bool
     */
    public function has(Game $game);

    /**
     * @param string $name
     * @param Platform $platform
     * @return Game
     * @throws UnknownGameException
     */
    public function findByNameAndPlatform($name, Platform $platform);

    /**
     * @param ListOptions $listOptions
     * @return Game[]
     */
    public function getList(ListOptions $listOptions);

}