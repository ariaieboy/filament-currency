# This is my package filament-currency

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ariaieboy/filament-currency.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/filament-currency)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ariaieboy/filament-currency/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ariaieboy/filament-currency/actions?query=workflow%3A"Fix+PHP+Code+Styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ariaieboy/filament-currency.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/filament-currency)

Filament V3 unlike V2 that uses [laravel-money](https://github.com/akaunting/laravel-money) package for formatting money TextColumns uses PHP native [NumberFormatter](https://www.php.net/manual/en/class.numberformatter.php) class.

This package will add a new `currency(string | Closure $currency = null, bool $shouldConvert = false)` method to the `TextColumn` that uses Filament V2 money formatter.

By using this package you can configure the formatter using [laravel-money config](https://github.com/akaunting/laravel-money/blob/master/config/money.php).

For example you can customize the `symbol`,`symbol_first`,`decimal_mark` and `thousands_separator` for each currency. Or if you want you can add your custom currency to the config and use it in `currency()` method instead of standard currencies.

## Installation

You can install the package via composer:

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
