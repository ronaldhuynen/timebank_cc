<x-jet-form-section submit="updateProfilePhone">
    <x-slot name="title">
        {{ __('Skills you share on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Add your skills to your profile.') }}
        <p> {{ __('Rare skills can be interesting for others, but very common skills are very usefull too!') }} </p>
    </x-slot>

    <x-slot name="form">

        <!-- Skills -->
        <div class="col-span-6  mb-6" 
        {{-- wire:init="phonecodeInit" --}}
        >
        <x-jet-label for="phone" value="{{ __('Skills, separated by a comma') }}" />
            <div class="col-span-2">

        <div>
            <input
                x-data="{ }"
                x-ref="input"
                x-init="new Tagify($refs.input,{
                    pattern: /^.{0,20}$/,   // max 20 characters
                    maxTags: 40,
                    whitelist:{{json_encode($suggestions)}},
                    dropdown: {   
                    position: 'text',  
                    maxItems: 7,           // <- mixumum allowed rendered suggestions
                    classname: 'tag-dropdown',
                    enabled: 2, // show suggestions on focus
                    closeOnSelect: true // don't hide the dropdown when an item is selected
                    }
                    })"
                    
                type="text"
                spellcheck='true'
                placeholder='Select or create tags'
                value="{{$tags }}"
                >
        </div>

                <x-input
                    {{-- name="tags" 
                    type="text" 
                    id="tags" --}}
                
                    placeholder="Writing English, Walking your dog, Moving house, Electronics repair"
                    wire:model.lazy="state.phone" 
                    class="placeholder-gray-300"/>
            </div>
            @error('phone')
                <p class="col-span-6 -mt-6 text-sm text-red-500">{{$message}}</p>
            @enderror

        <div class="col-span-6 mt-3">
            <x-checkbox id="right-label" label="Visible for my Timebank.cc friends" wire:model.defer="state.phone_public_for_friends" />
        </div>
        </div>
    </x-slot>



    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

    {{-- <script>
     var input = document.querySelector('input#tags');
 tagify = new Tagify(input);
 tagify.addTags(['laravel','Vue','React','PHP']);
    </script> --}}
</x-jet-form-section>
