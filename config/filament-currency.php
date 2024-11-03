<?php

return [
    /**
     * Since we support laravel-money version >=1 we used `CURRENCY_DEFAULT` env that is used in laravel-money 1<=version<=4
     * from version 5 laravel-money introduced a new config and env variable `MONEY_DEFAULTS_CURRENCY`
     * we use it in the fallback to support the laravel-money version 5.
     */
    'default_currency' => env('CURRENCY_DEFAULT', env('MONEY_DEFAULTS_CURRENCY', config('money.defaults.currency', 'USD'))),
    'default_convert' => env('MONEY_DEFAULTS_CONVERT', false),
];
