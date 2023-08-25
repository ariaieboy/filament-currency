<?php

namespace Ariaieboy\FilamentCurrency\Commands;

use Illuminate\Console\Command;

class FilamentCurrencyCommand extends Command
{
    public $signature = 'filament-currency';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
