<x-jet-form-section submit="saveTags">
    <x-slot name="title">
        {{ __('Skills you share on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Add your skills to your profile.') }}
        <p> {{ __('Rare skills can be interesting for others, but very common skills are very usefull too!') }} </p>
    </x-slot>

    <x-slot name="form">

        <!-- Skills -->
        <div class="col-span-6  mb-6">
        <x-jet-label for="skills" value="{{ __('Skills, separated by a comma') }}" />
            <div class="col-span-2">

        <div wire:ignore>
            <div                
             x-data="{ input: @entangle('tags')  }"
            >
            <input
                x-ref="input"
                x-init=" tagify = new Tagify($refs.input,{
                    pattern: /^.{0,50}$/,   // max 50 characters
                    maxTags: 40,
                    autocapitalize: true,
                    spellcheck: true,
                    whitelist:{{json_encode($suggestions)}},
                    callbacks        : {
                            add    : console.log,  // callback when adding a tag
                            remove : console.log   // callback when removing a tag
                        },
                    dropdown: {   
                        {{-- position: 'text',    --}}
                        maxItems: 7,           // <- mixumum allowed rendered suggestions
                        classname: 'tag-dropdown',
                        enabled: 3, // show suggestions on focus
                        closeOnSelect: true // don't hide the dropdown when an item is selected
                        }
                    });
                    $refs.input.addEventListener('change', onChange)
                    function onChange(e){
                        $wire.set('tags', e.target.value, true) // true sets defer to true
                    };"  
                type="text"
                placeholder='Select or create new tags'
                value="{{$tags}}"
                wire:key="uniqueKey"
                >
        </div>
        </div>
            </div>
            @error('tags')
                <p class="col-span-6 -mt-6 text-sm text-red-500">{{$message}}</p>
            @enderror
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
</x-jet-form-section>
