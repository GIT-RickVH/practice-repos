<?php

namespace PlaceHolderX\Exceptions;

class InvalidMemoryRepositoryItemsException extends \Exception
{
    const ERROR_MESSAGE = 'Given items to the memory repository should be an array or NULL.';

    /**
     * InvalidMemoryRepositoryItemsException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE);
    }
}