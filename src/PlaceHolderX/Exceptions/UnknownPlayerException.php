<?php

namespace PlaceHolderX\Exceptions;

class UnknownPlayerException extends \Exception
{
    const ERROR_MESSAGE = 'No player known with the username "%s".';

    /**
     * UnknownPlayerException constructor.
     */
    public function __construct($username)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $username));
    }

}