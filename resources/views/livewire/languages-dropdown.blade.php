<div>
    <x-select
        label="{{ __('What language(s) do you speak?') }}"
        placeholder="{{ __('Select (multiple) languages') }}"
        multiselect
        {{-- :options="[
            ['name' => 'Dutch - Good',  'id' => 0],
            ['name' => 'Engels - Beginner', 'id' => 1],
            ['name' => 'French - Good',   'id' => 2],
            ['name' => 'Spanish',    'id' => 3],
        ]" --}}
        :options="$langOptions"
        option-label="name"
        option-value="id"
        wire:model.defer="langSelected"
    />
{{-- {{ dump(json_encode($langSelected)) }} --}}
{{-- {{ dump(json_encode($languages)) }} --}}
</div>