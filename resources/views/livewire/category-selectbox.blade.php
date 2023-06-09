<div>
    <x-select
        label="{{ __('Category') }}"
        placeholder="{{ __('Select a category') }}"
        :options="$categoryOptions"
        option-label="name"
        option-value="category_id"
        wire:model="categorySelected"
    />
</div>