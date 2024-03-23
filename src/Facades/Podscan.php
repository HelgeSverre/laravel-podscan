<?php

namespace HelgeSverre\Podscan\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HelgeSverre\Podscan\Podscan
 */
class Podscan extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HelgeSverre\Podscan\Podscan::class;
    }
}
