<?php

namespace PlaceHolderX\Helpers\Repository;

use PlaceHolderX\Exceptions\InvalidSortDirectionException;

class SortOptions
{
    const SORT_DIRECTION_ASCENDING = 'asc';
    const SORT_DIRECTION_DESCENDING = 'desc';

    /**
     * @var string
     */
    private $sortBy;

    /**
     * @var string
     */
    private $sortDirection;

    /**
     * SortOptions constructor.
     * @param string $sortBy
     * @param string $sortDirection
     * @throws InvalidSortDirectionException When the given sort direction is invalid
     */
    public function __construct($sortBy, $sortDirection = self::SORT_DIRECTION_ASCENDING)
    {
        if (!in_array($sortDirection, [self::SORT_DIRECTION_ASCENDING, self::SORT_DIRECTION_DESCENDING])) {
            throw new InvalidSortDirectionException($sortDirection);
        }

        $this->sortBy = $sortBy;
        $this->sortDirection = $sortDirection;
    }

    /**
     * @return string
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * @return string
     */
    public function getSortDirection()
    {
        return $this->sortDirection;
    }

    /**
     * @param string $sortBy
     * @param string $sortDirection
     * @return SortOptions
     */
    public static function create($sortBy, $sortDirection = self::SORT_DIRECTION_ASCENDING)
    {
        return new self($sortBy, $sortDirection);
    }

}