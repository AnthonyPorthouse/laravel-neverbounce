<?php

namespace Groundsix\Neverbounce\Facades;

use Groundsix\Neverbounce\NeverBounce as NeverBounceConcrete;
use Illuminate\Support\Facades\Facade;

class NeverBounce extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return NeverBounceConcrete::class;
    }
}
