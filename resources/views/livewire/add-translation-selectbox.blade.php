<div>
    <x-select
        label="{{ __('Language') }} * "
        placeholder="{{ __('Select language') }}"
        :options="$options"
        option-label="name"
        option-value="lang_code"
        wire:model.live="localeSelected"
        class="asteriks-red"
    />
    @error('locale')
    <div class="mt-2 text-sm text-red-600" id="locale-error">{{ $message }}</div>
    @enderror
</div>