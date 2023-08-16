<x-jet-form-section submit="">
    <x-slot name="title">
        {{ __('Activities your organization offers on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add activities / skills to your organization profile.') }}<br /><br />
        {{ __('Rare skills can be interesting for others, but very common skills are very usefull too!') }}
    </x-slot>

    <x-slot name="form">
        </div>
            @livewire('skills-form')
        <div>
    </x-slot>
</x-jet-form-section>
