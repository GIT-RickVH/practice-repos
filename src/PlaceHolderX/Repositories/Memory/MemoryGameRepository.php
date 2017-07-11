<?php

namespace PlaceHolderX\Repositories\Memory;

use PlaceHolderX\Comparators\GameComparator;
use PlaceHolderX\Exceptions\UnknownGameException;
use PlaceHolderX\Helpers\Repository\ListOptions;
use PlaceHolderX\Helpers\Repository\SortOptions;
use PlaceHolderX\Helpers\Repository\SortOptions\GameSortOptions;
use PlaceHolderX\Models\Game;
use PlaceHolderX\Models\Platform;
use PlaceHolderX\Repositories\GameRepository;

class MemoryGameRepository extends AbstractMemoryRepository implements GameRepository
{
    /**
     * @param Game $game
     */
    public function save(Game $game)
    {
        $this->items[] = $game;
    }

    /**
     * @param Game $game
     * @return bool
     */
    public function has(Game $game)
    {
        foreach ($this->items as $existingGame) {
            if (GameComparator::equals($game, $existingGame)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $name
     * @param Platform $platform
     * @return Game
     * @throws UnknownGameException
     */
    public function findByNameAndPlatform($name, Platform $platform)
    {
        foreach ($this->items as $existingGame) {
            if (GameComparator::equalsNameAndPlatform($existingGame, $name, $platform)) {
                return $existingGame;
            }
        }

        throw new UnknownGameException($name, $platform->getName());
    }

    /**
     * @param ListOptions $listOptions
     * @return array
     */
    public function getList(ListOptions $listOptions)
    {
        $list = [];
        foreach ($this->items as $game) {
            $list[] = $game;
        }

        if ($listOptions->hasSortOptions()) {
            $list = $this->applySorting($listOptions->getSortOptions(), $list);
        }

        if ($listOptions->hasLimitOptions()) {
            $list = $this->applyLimit($listOptions->getLimitOptions(), $list);
        }

        return $list;
    }

    /**
     * @param SortOptions $sortOptions
     * @param array $list
     * @return array
     */
    private function applySorting(SortOptions $sortOptions, array $list)
    {
        if ($sortOptions->getSortBy() == GameSortOptions::SORT_BY_GAME_NAME) {
            $sortDirection = $sortOptions->getSortDirection();
            usort($list, function (Game $gameA, Game $gameB) use ($sortDirection) {
                $modifier = ($sortDirection == GameSortOptions::SORT_DIRECTION_DESCENDING) ? -1 : 1;
                return strcmp($gameA->getName(), $gameB->getName()) * $modifier;
            });
        }

        return $list;
    }

}