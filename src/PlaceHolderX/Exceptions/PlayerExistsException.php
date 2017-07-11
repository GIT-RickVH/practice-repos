<?php

namespace PlaceHolderX\Exceptions;

class PlayerExistsException extends \Exception
{
    const ERROR_MESSAGE = 'The player with the username "%s" already exists.';

    /**
     * PlayerExistsException constructor.
     * @param string $username
     */
    public function __construct($username)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $username));
    }

}