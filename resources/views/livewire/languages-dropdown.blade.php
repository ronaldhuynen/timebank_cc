<div>
    <x-select
    label="{{__('What language(s) do you speak?') }}"
    placeholder="{{ __('Select (multiple) languages, where ☆☆☆ is highest level') }}"
    multiselect
    :options="$languages"
    wire:model.lazy="langSelected"
/>
{{-- {{ dump(json_encode($langSelected)) }} --}}
</div>
