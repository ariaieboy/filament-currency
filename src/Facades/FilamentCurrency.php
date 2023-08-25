<?php

namespace Ariaieboy\FilamentCurrency\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ariaieboy\FilamentCurrency\FilamentCurrency
 */
class FilamentCurrency extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ariaieboy\FilamentCurrency\FilamentCurrency::class;
    }
}
