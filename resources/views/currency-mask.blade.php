@php
    $datalistOptions = $getDatalistOptions();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $hasInlineLabel = $hasInlineLabel();
    $id = $getId();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $isPasswordRevealable = $isPasswordRevealable();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $mask = $getMask();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $xmask = "\$money(\$input,'$decimalSeparator','$thousandSeparator',$precision)";
    $xmodel = "x-model".($isLive?($isLiveOnBlur?".lazy":($isLiveDebounced?(".debounce.".$liveDebounce."ms"):"")):"");
    $xdata = <<<JS
    {
        input:\$wire.{$applyStateBindingModifiers("\$entangle('{$statePath}')")},
        masked:'',
        init(){
        \$nextTick(this.updateMasked());
        \$watch('masked',(value, oldValue)=>this.updateInput(value,oldValue));
        \$watch('input', () => this.updateMasked());
        },
        updateMasked(){
            if(this.input !== undefined && typeof Number(this.input) === 'number') {
                if(this.masked?.replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.') !== this.input){
                    this.masked = this.input?.toString().replaceAll('.','$decimalSeparator');
                }
            }
        },
        updateInput(value, oldValue){
            if(value?.replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.') !== oldValue?.replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.')){
                this.input = this.masked?.replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.');
            }
        }
    }
JS;
@endphp

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field">
    <x-slot
            name="label"
            @class([
                'sm:pt-1.5' => $hasInlineLabel,
            ])
    >
        {{ $getLabel() }}
    </x-slot>
    <x-filament::input.wrapper
            :disabled="$isDisabled"
            :inline-prefix="$isPrefixInline"
            :inline-suffix="$isSuffixInline"
            :prefix="$prefixLabel"
            :prefix-actions="$prefixActions"
            :prefix-icon="$prefixIcon"
            :suffix="$suffixLabel"
            :suffix-actions="$suffixActions"
            :suffix-icon="$suffixIcon"
            :suffix-icon-color="$getSuffixIconColor()"
            :valid="! $errors->has($statePath)"
            class="fi-fo-text-input"
            :attributes="
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class(['fi-fo-text-input overflow-hidden'])
        "
    >
        <x-filament::input
                :attributes="
                \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                    ->merge($extraAlpineAttributes, escape: false)
                    ->merge([
                        'autocapitalize' => $getAutocapitalize(),
                        'autocomplete' => $getAutocomplete(),
                        'autofocus' => $isAutofocused(),
                        'disabled' => $isDisabled,
                        'id' => $id,
                        'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                        'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                        'inputmode' => $getInputMode(),
                        'list' => $datalistOptions ? $id . '-list' : null,
                        'max' => (! $isConcealed) ? $getMaxValue() : null,
                        'maxlength' => (! $isConcealed) ? $getMaxLength() : null,
                        'min' => (! $isConcealed) ? $getMinValue() : null,
                        'minlength' => (! $isConcealed) ? $getMinLength() : null,
                        'placeholder' => $getPlaceholder(),
                        'readonly' => $isReadOnly(),
                        'required' => $isRequired() && (! $isConcealed),
                        'step' => $getStep(),
                        'type' => 'text',
                        'x-data' => $xdata,
                        $xmodel =>'masked',
                        'x-mask:dynamic' => $xmask
                    ], escape: false)
            "
        />
    </x-filament::input.wrapper>

    @if ($datalistOptions)
        <datalist id="{{ $id }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}"/>
            @endforeach
        </datalist>
    @endif
</x-dynamic-component>
