<form>

    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
        <x-select id="update"
            label=" {{ __('Select social media profile')}}"
            placeholder="{{$selectedPlaceholder->name}}"
            option-label="name"
            option-value="id"
            wire:model.live="socialsOptionSelected"
            wire:key="{{ $socialsOptionSelected}}.select">
            @foreach ($socialsOptions as $socialOption)
                <x-select.user-option src="{{ Storage::url($socialOption->icon) }}" label="{{$socialOption->name}}" value="{{ $socialOption->id }}"/>
            @endforeach
        </x-select>
    </div>
        <div class="grid grid-cols-1 gap-6 mt-3 mb-3 md:grid-cols-2">
        <x-jetstream.input wire:model.live="userOnSocial" label="Username on medium" placeholder="AccountName" prefix="@ " />
        @if(App\Models\Social::find($socialsOptionSelected))
            @if(Str::contains(App\Models\Social::find($socialsOptionSelected)->url_structure, '#'))
            <x-jetstream.input wire:model.live="serverOfSocial" label="Server of social" placeholder="Server name" prefix="@ " />
            @endif
        @endif
        </div>
        <div>
            <button wire:click.prevent="update()" class="inline-flex items-center px-4 py-2 mr-3 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition">{{__('Update')}}</button>
            <button wire:click.prevent="cancel()" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition">{{__('Cancel')}}</button>
        </div>
</form>