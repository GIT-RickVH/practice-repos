<?php

namespace PlaceHolderX\Comparators;

use PlaceHolderX\Models\Player;

class PlayerComparator
{

    /**
     * @param Player $playerA
     * @param Player $playerB
     * @return bool
     */
    public static function equals(Player $playerA, Player $playerB)
    {
        return strcmp($playerA->getUsername(), $playerB->getUsername()) === 0;
    }

}