<?php

namespace Ariaieboy\FilamentCurrency;

use Ariaieboy\FilamentCurrency\Commands\FilamentCurrencyCommand;
use Ariaieboy\FilamentCurrency\Testing\TestsFilamentCurrency;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Icon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
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
