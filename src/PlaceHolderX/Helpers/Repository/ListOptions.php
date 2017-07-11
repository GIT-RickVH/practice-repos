<?php

namespace PlaceHolderX\Helpers\Repository;

class ListOptions
{

    /**
     * @var SortOptions
     */
    private $sortOptions;

    /**
     * @var LimitOptions
     */
    private $limitOptions;

    /**
     * @return bool
     */
    public function hasSortOptions()
    {
        return $this->sortOptions instanceof SortOptions;
    }

    /**
     * @return SortOptions
     */
    public function getSortOptions()
    {
        return $this->sortOptions;
    }

    /**
     * @param SortOptions $sortOptions
     * @return ListOptions
     */
    public function setSortOptions(SortOptions $sortOptions)
    {
        $this->sortOptions = $sortOptions;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasLimitOptions()
    {
        return $this->limitOptions instanceof LimitOptions;
    }

    /**
     * @return LimitOptions
     */
    public function getLimitOptions()
    {
        return $this->limitOptions;
    }

    /**
     * @param LimitOptions $limitOptions
     * @return ListOptions
     */
    public function setLimitOptions(LimitOptions $limitOptions)
    {
        $this->limitOptions = $limitOptions;
        return $this;
    }


    /**
     * @return ListOptions
     */
    public static function create()
    {
        return new self();
    }

}