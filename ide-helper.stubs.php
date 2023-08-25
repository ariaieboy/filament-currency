<?php

namespace Filament\Tables\Columns {

    use Closure;

    class TextColumn
    {
        public function currency(string | Closure $currency = null, bool $shouldConvert = false): self
        {
            return $this;
        }
    }
}
