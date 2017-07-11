<?php

namespace PlaceHolderX\Comparators;

use PlaceHolderX\Models\Platform;

class PlatformComparator
{

    /**
     * @param Platform $platformA
     * @param Platform $platformB
     * @return bool
     */
    public static function equals(Platform $platformA, Platform $platformB)
    {
        return $platformA->getName() == $platformB->getName();
    }

}