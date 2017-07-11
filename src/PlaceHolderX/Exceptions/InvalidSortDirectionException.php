<?php

namespace PlaceHolderX\Exceptions;

class InvalidSortDirectionException extends \Exception
{
    const ERROR_MESSAGE = 'Invalid sort direction "%s" given.';

    /**
     * InvalidSortDirectionException constructor.
     * @param string $invalidSortDirection
     */
    public function __construct($invalidSortDirection)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $invalidSortDirection));
    }


}