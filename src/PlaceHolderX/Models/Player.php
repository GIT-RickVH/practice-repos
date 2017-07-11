<?php

namespace PlaceHolderX\Models;

class Player
{

    /**
     * @var string
     */
    private $username;

    /**
     * Player constructor.
     * @param string $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

}