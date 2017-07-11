<?php

namespace PlaceHolderX\Helpers\Repository;

class LimitOptions
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var int
     */
    private $offset;

    /**
     * LimitOptions constructor.
     * @param int $amount
     * @param int $offset
     */
    public function __construct($amount, $offset = 0)
    {
        $this->amount = $amount;
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $amount
     * @param int $offset
     * @return LimitOptions
     */
    public static function create($amount, $offset = 0)
    {
        return new self($amount, $offset);
    }

}