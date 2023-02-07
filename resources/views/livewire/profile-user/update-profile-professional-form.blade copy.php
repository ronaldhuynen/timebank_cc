<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Professional') }}
    </x-slot>

    <x-slot name="description">
        {{ __('What professional experience do you have?') }}
    </x-slot>

    <x-slot name="form">

         <!-- About Me -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model.defer="state.about" label="About me" placeholder="{{__('Short intro or background info')}}" />
            <x-jet-input-error for="about" class="mt-2" />
        </div>


        <!-- Motivation -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model.defer="state.motivation" label="{{ __('Why I am a Timbanker') }}" placeholder="{{__('Just trying out or serious about a new value system?')}}" />
            <x-jet-input-error for="motivation" class="mt-2" />
        </div>


        <!-- Birth Date -->
        <!-- FIXME: use proper localized date picker without if's-->
        @if (Illuminate\Support\Facades\App::isLocale('nl'))
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD-MM-YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @elseif(Illuminate\Support\Facades\App::isLocale('be'))
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD.MM.YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @elseif(Illuminate\Support\Facades\App::isLocale('de'))
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD.MM.YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @else
        {{-- Presume en is the locale --}}
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD/MM/YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @endif

        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="state.website" value="{{ __('Website') }}" />
            <x-input
                class="!pl-[3.8rem]"
                placeholder="website.org"
                prefix="https://"
                wire:model.defer="state.website"
            />
            <x-jet-input-error for="state.website" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

