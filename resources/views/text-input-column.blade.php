@php
    use Filament\Support\Enums\Alignment;use Filament\Support\Facades\FilamentAsset;use Filament\Support\Facades\FilamentView;use Filament\Tables\Table;use Illuminate\Support\Js;

    $isDisabled = $isDisabled();
    $state = $getState();
    $mask = $getMask();

    $alignment = $getAlignment() ?? Alignment::Start;

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }

    $xmask = "\$money(\$input,'$decimalSeparator','$thousandSeparator',$precision)";
    $xchange = <<<JS

                                isLoading = true

                                const response = await \$wire.updateTableColumnState(
                                    name,
                                    recordKey,
                                    \$event.target.value.toString()?.replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.'),
                                )

                                error = response?.error ?? undefined

                                if (! error) {
                                    if(state?.toString().replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.') !== response.toString()){
                                    state = response
                                    }
                                }

                                isLoading = false
JS;
    $attributes = $attributes
            ->merge($getExtraAttributes(), escape: false)
            ->merge([
                'x-load' => FilamentView::hasSpaMode()
                    ? 'visible || event (x-modal-opened)'
                    : true,
                'x-load-src' => FilamentAsset::getAlpineComponentSrc('columns/text-input', 'filament/tables'),
            ], escape: false)
            ->class([
                'fi-ta-text-input',
                'fi-inline' => $isInline(),
            ]);
    $inputAttributes = $getExtraInputAttributeBag()
            ->merge([
                'disabled' => $isDisabled,
                'wire:loading.attr' => 'disabled',
                'wire:target' => implode(',', Table::LOADING_TARGETS),
                'x-bind:disabled' => $isDisabled ? null : 'isLoading',
                'inputmode' => $getInputMode(),
                'placeholder' => $getPlaceholder(),
                'step' => $getStep(),
                'type' => 'text',
                'x-mask:dynamic' => $xmask,
                'x-on:change' . ($type === 'number' ? '.debounce.1s' : null) => $xchange,
                'x-tooltip' => filled($tooltip = $getTooltip($state))
                    ? '{
                        content: ' . Js::from($tooltip) . ',
                        theme: $store.theme,
                    }'
                    : null,
            ], escape: false)
            ->class([
                'fi-input',
                ($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : (is_string($alignment) ? $alignment : ''),
            ]);
@endphp

<div
        wire:ignore.self
        x-data="{
        error: undefined,

        isEditing: false,

        isLoading: false,

        name: @js($getName()),

        recordKey: @js($getRecordKey()),

        state: @js($state),
    }"
        x-init="
        () => {
            Livewire.hook('commit', ({ component, commit, succeed, fail, respond }) => {
                succeed(({ snapshot, effect }) => {
                    $nextTick(() => {
                        if (component.id !== @js($this->getId())) {
                            return
                        }

                        if (isEditing) {
                            return
                        }

                        if (! $refs.newState) {
                            return
                        }

                        let newState = $refs.newState.value?.toString().replaceAll('{{$thousandSeparator}}','').replaceAll('{{$decimalSeparator}}','.')

                        if (state?.toString().replaceAll('{{$thousandSeparator}}','').replaceAll('{{$decimalSeparator}}','.') === newState) {
                            return
                        }

                        state = newState
                    })
                })
            })
        }
    "
    <?= $attributes->toHtml() ?>
>
    <input
            type="hidden"
            value="{{ str($state)->replace('"', '\\"')->replace(',','') }}"
            x-ref="newState"
    />
    <div
            x-bind:class="{
                    'fi-disabled': isLoading || <?= Js::from($isDisabled) ?>,
                    'fi-invalid': error !== undefined,
                }"
            x-tooltip="
                    error === undefined
                        ? false
                        : {
                            content: error,
                            theme: $store.theme,
                        }
                "
            x-on:click.stop=""
            class="fi-input-wrp"
    >
        <input
                x-model.lazy="state"
            <?= $inputAttributes->toHtml() ?>
        />
    </div>
</div>
