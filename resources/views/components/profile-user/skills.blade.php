<x-form-section submit="saveTags">
    <x-slot name="title">
        {{ __('Skills you share on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Add your skills to your profile.') }}
        <p> {{ __('Rare skills can be interesting for others, but very common skills are very usefull too!') }} </p>
    </x-slot>

    <x-slot name="form">
        </div>
        @livewire('skills-form')
    </x-slot>
</x-form-section>
