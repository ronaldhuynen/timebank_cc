<div>
    <x-select
        label="{{ __('What language(s) do you speak?') }} *"
        placeholder="{{ __('Select (multiple) languages') }}"
        multiselect
        :options="$langOptions"
        option-label="name"
        option-value="id"
        wire:model.live="langSelected"
    />
</div>