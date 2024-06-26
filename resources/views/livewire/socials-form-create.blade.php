<form>
    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 ">
        <x-select id="create"
            label="{{ __('Add social media profiles') }}"
            placeholder="{{ __('Select a social medium') }}"
            wire:model="socialsOptionSelected"
            class="placeholder-gray-300"
            >
            @foreach ($socialsOptions as $option)
                <x-select.option src="{{ Storage::url($option->icon) }}" label="{{ $option->name}}" value="{{ $option->id }}" />
            @endforeach
        </x-select>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-3 mb-3 md:grid-cols-2">
        @if(App\Models\Social::find($socialsOptionSelected))
            @if(App\Models\Social::find($socialsOptionSelected)->url_structure === '')
            <x-input wire:model="userOnSocial" label="{{ __('Link to your page on social medium') }}" placeholder="Link or URL addres" prefix=" " class="placeholder-gray-300"/>
            @else

        <x-input wire:model="userOnSocial" label="{{ __('Your username on social medium') }}" placeholder="Account Name" prefix="@ " class="placeholder-gray-300"/>
            @if(Str::contains(App\Models\Social::find($socialsOptionSelected)->url_structure, '#'))
            <x-input wire:model="serverOfSocial" label="Server of social" placeholder="Server name" prefix="@ " />
            @endif
            @endif

        @endif
    </div>

    <button wire:click.prevent="store()" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition">{{__('Add social medium')}}</button>
            @if (session()->has('message'))
            <span x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition:leave.opacity.duration.1500ms>
                <span class="ml-3 text-sm text-gray-600">
                    {{ session('message') }}
                </span>
            </span>
            @endif

</form>