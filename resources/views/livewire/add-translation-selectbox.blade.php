<div>
    <x-select
        label="{{ __('Add translation') }} * "
        placeholder="{{ __('Select language') }}"
        :options="$langOptions"
        option-label="name"
        option-value="lang_code"
        wire:model.live="localeSelected"
        class="asteriks-red"
    />
    @error('locale')
    <div class="mt-2 text-sm text-red-600" id="locale-error">{{ $message }}</div>
    @enderror

{{--Style asterisk symbol to red --}}
{{-- TODO: prevent 'Uncaught TypeError: $ is not a function' error when modal is still hiddden --}}
    {{-- <script>
        $('.asteriks-red').each(function(){
        this.innerHTML = this.innerHTML.replace(/\*/g, '<span class="text-red-600">*</span>');
        });
    </script> --}}

</div>