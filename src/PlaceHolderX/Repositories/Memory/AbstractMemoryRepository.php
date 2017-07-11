<?php

namespace PlaceHolderX\Repositories\Memory;

use PlaceHolderX\Exceptions\InvalidMemoryRepositoryItemsException;
use PlaceHolderX\Helpers\Repository\LimitOptions;

abstract class AbstractMemoryRepository
{
    /**
     * @var array
     */
    protected $items;

    /**
     * MemoryGameRepository constructor.
     * @param array|null $items
     * @throws \Exception When the given items are not NULL or an array
     */
    public function __construct($items = null)
    {
        if ($items !== null && !is_array($items)) {
            throw new InvalidMemoryRepositoryItemsException();
        }

        $this->items = (is_array($items)) ? $items : [];
    }

    /**
     * @param LimitOptions $limitOptions
     * @param array $list
     * @return array
     */
    protected function applyLimit(LimitOptions $limitOptions, array $list)
    {
        return array_slice($list, $limitOptions->getOffset(), $limitOptions->getAmount());
    }

}