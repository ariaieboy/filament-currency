<?php

namespace Ariaieboy\FilamentCurrency;

use Akaunting\Money;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Summarizers;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentCurrencyServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-currency';

    public static string $viewNamespace = 'filament-currency';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews();
    }

    public function bootingPackage(): void
    {
        $formatter = static function ($state, $evaluator, $currency, $shouldConvert) {
            if (blank($state)) {
                return null;
            }

            if (blank($currency)) {
                $currency = config('filament-currency.default_currency');
            }
            if (is_null($shouldConvert)) {
                $shouldConvert = config('filament-currency.default_convert');
            }

            return (new Money\Money(
                $state,
                (new Money\Currency(strtoupper($evaluator->evaluate($currency)))),
                $shouldConvert,
            ))->format();
        };

        TextColumn::macro('currency', function (string | Closure | null $currency = null, ?bool $shouldConvert = null) use ($formatter): TextColumn {
            /**
             * @var TextColumn $this
             */
            $this->formatStateUsing(static function (Column $column, $state) use ($currency, $shouldConvert, $formatter): ?string {

                return $formatter($state, $column, $currency, $shouldConvert);

            });

            return $this;
        });

        Summarizers\Summarizer::macro('currency', function (string | Closure | null $currency = null, ?bool $shouldConvert = null) use ($formatter): Summarizers\Summarizer {
            /**
             * @var Summarizers\Sum $this
             */
            $this->formatStateUsing(static function (Summarizers\Summarizer $summarizer, $state) use ($currency, $shouldConvert, $formatter): ?string {

                return $formatter($state, $summarizer, $currency, $shouldConvert);
            });

            return $this;
        });

        Summarizers\Sum::macro('currency', function (string | Closure | null $currency = null, ?bool $shouldConvert = null) use ($formatter): Summarizers\Sum {
            /**
             * @var Summarizers\Sum $this
             */
            $this->formatStateUsing(static function (Summarizers\Summarizer $summarizer, $state) use ($currency, $shouldConvert, $formatter): ?string {

                return $formatter($state, $summarizer, $currency, $shouldConvert);

            });

            return $this;
        });

        Summarizers\Average::macro('currency', function (string | Closure | null $currency = null, ?bool $shouldConvert = null) use ($formatter): Summarizers\Average {
            /**
             * @var Summarizers\Average $this
             */
            $this->formatStateUsing(static function (Summarizers\Summarizer $summarizer, $state) use ($currency, $shouldConvert, $formatter): ?string {

                return $formatter($state, $summarizer, $currency, $shouldConvert);

            });

            return $this;
        });

        TextEntry::macro('currency', function (string | Closure | null $currency = null, ?bool $shouldConvert = null) use ($formatter): TextEntry {
            /**
             * @var TextEntry $this
             */
            $this->formatStateUsing(static function (TextEntry $column, $state) use ($currency, $shouldConvert, $formatter): ?string {

                return $formatter($state, $column, $currency, $shouldConvert);

            });

            return $this;
        });

        TextInput::macro('currencyMask', function ($thousandSeparator = ',', $decimalSeparator = '.', $precision = 2): TextInput {
            /**
             * @var TextInput $this
             */
            $this->view = 'filament-currency::currency-mask';
            $this->viewData(compact('thousandSeparator', 'decimalSeparator', 'precision'));

            return $this;
        });
        TextInputColumn::macro('currencyMask', function ($thousandSeparator = ',', $decimalSeparator = '.', $precision = 2): TextInputColumn {
            /**
             * @var TextInputColumn $this
             */
            $this->view = 'filament-currency::text-input-column';
            $this->viewData(compact('thousandSeparator', 'decimalSeparator', 'precision'));

            return $this;
        });
    }
}
