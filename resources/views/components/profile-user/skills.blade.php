<x-jetstream.form-section submit="saveTags">
    <x-slot name="title">
        {{ __('Activies you share on Timebank.cc') }}
    </x-slot>

    <x-slot name="description">
        <p>{{ __('Which activities and skills can you share on Timebank? Give practical examples, avoid vague or general keywords.') }}
        <p> {{ __('Rare skills can be interesting for others, but very common activities are also very useful to offer!') }} </p>
    </x-slot>

    <x-slot name="form">
        </div>
        @livewire('skills-form')
    </x-slot>
</x-jetstream.form-section>
