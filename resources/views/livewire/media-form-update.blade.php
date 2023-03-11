<form>

    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
        <x-select id="update"
            label="Select social media profile"
            placeholder="{{$selectedPlaceholder->name}}"
            option-label="name"
            option-value="id"
            wire:model="mediaOptionSelected"
            wire:key="{{ $mediaOptionSelected}}.select">
            @foreach ($mediaOptions as $mediumOption)
                <x-select.user-option src="{{ Storage::url($mediumOption->icon) }}" label="{{$mediumOption->name}}" value="{{ $mediumOption->id }}"/>
            @endforeach
        </x-select>
    </div>
        <div class="grid grid-cols-1 gap-6 mt-3 mb-3 md:grid-cols-2">
        <x-input wire:model="userOnMedium" label="Username on medium" placeholder="AccountName" prefix="@ " />
        @if(App\Models\Medium::find($mediaOptionSelected))
            @if(Str::contains(App\Models\Medium::find($mediaOptionSelected)->url_structure, '#'))
            <x-input wire:model="serverOfMedium" label="Server of medium" placeholder="Server name" prefix="@ " />
            @endif
        @endif
        </div>
        <div>
            <button wire:click.prevent="update()" class="inline-flex items-center px-4 py-2 mr-3 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition">{{__('Update')}}</button>
            <button wire:click.prevent="cancel()" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition">{{__('Cancel')}}</button>
        </div>
</form>