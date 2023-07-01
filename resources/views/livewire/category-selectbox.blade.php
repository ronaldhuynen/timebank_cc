<div>
    <x-select
        label="{{ __('Category') }} * "
        placeholder="{{ __('Select a category') }}"
        :options="$categoryOptions"
        option-label="name"
        option-value="category_id"
        wire:model="categorySelected"
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
