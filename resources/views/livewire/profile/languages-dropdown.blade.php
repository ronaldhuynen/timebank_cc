<div>
    <x-select
        label="{{ $label . ' *' }}"
        placeholder="{{ __('Select (multiple) languages') }}"
        multiselect
        :options="$langOptions"
        option-label="name"
        option-value="id"
        wire:model.live="langSelected"
    />
</div>