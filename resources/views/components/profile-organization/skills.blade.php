<x-jet-form-section submit="saveTags">
    <x-slot name="title">
        {{ __('Activities your organization offers on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Add activities / skills to your organization profile.') }}
        <p> {{ __('Rare skills can be interesting for others, but very common skills are very usefull too!') }} </p>
    </x-slot>

    <x-slot name="form">
        </div>
        @livewire('skills-form')
    </x-slot>
</x-jet-form-section>
