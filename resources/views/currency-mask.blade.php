@php
    use Filament\Forms\Components\TextInput\Actions\HidePasswordAction;
    use Filament\Forms\Components\TextInput\Actions\ShowPasswordAction;

    $fieldWrapperView = $getFieldWrapperView();
    $datalistOptions = $getDatalistOptions();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $extraAttributeBag = $getExtraAttributeBag();
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
    $prefixIconColor = $getPrefixIconColor();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixIconColor = $getSuffixIconColor();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $xmask = "\$money(\$input,'$decimalSeparator','$thousandSeparator',$precision)";
    $xmodel = "x-model".($isLive()?($isLiveOnBlur()?".lazy":($isLiveDebounced()?(".debounce.".$getLiveDebounce()."ms"):"")):"");
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
                if(this.masked?.toString().replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.') !== this.input){
                    this.masked = this.input?.toString().replaceAll('.','$decimalSeparator');
                }
            }
        },
        updateInput(value, oldValue){
            if(value?.toString().replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.') !== oldValue?.toString().replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.')){
                this.input = this.masked?.toString().replaceAll('$thousandSeparator','').replaceAll('$decimalSeparator','.');
            }
        }
    }
JS;

    $inputAttributes = $getExtraInputAttributeBag()
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
            $xmodel =>'masked',
            'x-data' => $xdata,
            'x-bind:type' => $isPasswordRevealable ? 'isPasswordRevealed ? \'text\' : \'password\'' : null,
            'x-mask:dynamic'=> $xmask,
        ], escape: false)
        ->class([
            'fi-revealable' => $isPasswordRevealable,
        ]);
@endphp

<x-dynamic-component
        :component="$fieldWrapperView"
        :field="$field"
        :has-inline-label="$hasInlineLabel"
        class="fi-fo-text-input-wrp"
>
    <x-filament::input.wrapper
            :disabled="$isDisabled"
            :inline-prefix="$isPrefixInline"
            :inline-suffix="$isSuffixInline"
            :prefix="$prefixLabel"
            :prefix-actions="$prefixActions"
            :prefix-icon="$prefixIcon"
            :prefix-icon-color="$prefixIconColor"
            :suffix="$suffixLabel"
            :suffix-actions="$suffixActions"
            :suffix-icon="$suffixIcon"
            :suffix-icon-color="$suffixIconColor"
            :valid="! $errors->has($statePath)"
            :x-data="$xData"
            :attributes="
            \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                ->class(['fi-fo-text-input'])
        "
    >
        <input
                {{
                    $inputAttributes->class([
                        'fi-input',
                        'fi-input-has-inline-prefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                        'fi-input-has-inline-suffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                    ])
                }}
        />
    </x-filament::input.wrapper>

    @if ($datalistOptions)
        <datalist id="{{ $id }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}"></option>
            @endforeach
        </datalist>
    @endif
</x-dynamic-component>
