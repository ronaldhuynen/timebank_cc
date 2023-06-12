<div>
    <x-select
        label="{{ __('Language') }}"
        placeholder="{{ __('Select a language') }}"
        :options="$langOptions"
        option-label="name"
        option-value="lang_code"
        wire:model="localeSelected"
    />
</div>