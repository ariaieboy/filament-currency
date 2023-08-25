<?php

namespace Ariaieboy\FilamentCurrency;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentCurrencyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-currency';

    public static string $viewNamespace = 'filament-currency';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);
    }
}
