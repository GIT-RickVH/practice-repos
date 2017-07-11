<?php

namespace PlaceHolderX\Exceptions;

class UnknownGameException extends \Exception
{
    const ERROR_MESSAGE = 'No game known by the name "%s" for the "%s" platform.';

    /**
     * UnknownGameException constructor.
     * @param string $gameName
     * @param string $platformName
     */
    public function __construct($gameName, $platformName)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $gameName, $platformName));
    }


}