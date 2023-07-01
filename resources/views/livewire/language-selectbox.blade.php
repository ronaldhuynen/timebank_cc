<div>
    <x-select
        label="{{ __('Language') }} * "
        placeholder="{{ __('Select a language') }}"
        :options="$langOptions"
        option-label="name"
        option-value="lang_code"
        wire:model="localeSelected"
        class="asteriks-red"
    />

{{--Style asterisk symbol to red --}}
{{-- TODO: prevent 'Uncaught TypeError: $ is not a function' error when modal is still hiddden --}}
    {{-- <script>
        $('.asteriks-red').each(function(){
        this.innerHTML = this.innerHTML.replace(/\*/g, '<span class="text-red-600">*</span>');
        });
    </script> --}}

</div>