# Enhanced Currency Related stuff for Filament
![filament currency](https://banners.beyondco.de/Filament%20Currency.jpeg?theme=dark&packageManager=composer+require&packageName=ariaieboy%2Ffilament-currency&pattern=texture&style=style_2&description=Filament+laravel-money+formatter&md=1&showWatermark=1&fontSize=150px&images=currency-dollar&widths=500&heights=500)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ariaieboy/filament-currency.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/filament-currency)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ariaieboy/filament-currency/fix-php-code-styling.yml?label=code%20style&style=flat-square)](https://github.com/ariaieboy/filament-currency/actions?query=workflow%3A"Fix+PHP+Code+Styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ariaieboy/filament-currency.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/filament-currency)

Filament V3 unlike V2 that uses [laravel-money](https://github.com/akaunting/laravel-money) package for formatting money TextColumns uses PHP native [NumberFormatter](https://www.php.net/manual/en/class.numberformatter.php) class.

### Text Column (Table Builder)

A new `currency(string | Closure $currency = null, bool $shouldConvert = false)` method to the `TextColumn` that uses the Filament V2 money formatter.

### Summary (Table Builder)

The summarizer classes `Sum` and `Average` contains the method `currency(string | Closure $currency = null, bool $shouldConvert = false)` to display the value in the configured currency format.

### Text Entry (InfoLists)

A new `currency(string | Closure $currency = null, bool $shouldConvert = false)` method to the `TextEntry`

### Text Input (Form Builder)

We also have a `currencyMask()` method for `TextInput` that lets you mask your numbers in front-end and return the plain number to back-end.

### Text Input Column (Table Builder)

We also have a `currencyMask()` method for `TextInputColumn` that lets you mask your numbers in front-end and return the plain number to back-end.

By using this package you can configure the formatter using [laravel-money config](https://github.com/akaunting/laravel-money/blob/master/config/money.php).

For example, you can customize the `symbol`, `symbol_first`, `decimal_mark`, and `thousands_separator` for each currency. Or if you want you can add your custom currency to the config and use it in the `currency()` method instead of standard money.

## Installation

You can install the package via Composer:

```bash
composer require ariaieboy/filament-currency
```

You can publish the laravel-money config file with:

```bash
php artisan vendor:publish --tag=money
```

## Usage

```php
\Filament\Tables\Columns\TextColumn::make('money')
    ->currency('USD');

\Filament\Tables\Columns\TextColumn::make('money')
    ->currency('USD')
    ->summarize(\Filament\Tables\Columns\Summarizers\Sum::make()->currency());

\Filament\Tables\Columns\TextColumn::make('money')
    ->currency('USD')
    ->summarize(\Filament\Tables\Columns\Summarizers\Average::make()->currency());

\Filament\Infolists\Components\TextEntry::make('money')
    ->currency('USD');

\Filament\Forms\Components\TextInput::make('money')
    ->currencyMask(thousandSeparator: ',',decimalSeparator: '.',precision: 2)
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [AriaieBOY](https://github.com/ariaieboy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
