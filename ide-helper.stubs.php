<?php

namespace Filament\Tables\Columns {

    use Closure;

    class TextColumn
    {
        public function currency(string | Closure | null $currency = null, bool $shouldConvert = false): self
        {
            return $this;
        }
    }
}

namespace Filament\Forms\Components {
    class TextInput
    {
        public function currencyMask($thousandSeparator = ',', $decimalSeparator = '.', $precision = 2): self
        {
            return $this;
        }
    }
}
