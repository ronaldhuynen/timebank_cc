<form>
    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
        <x-select id="create"
            label="{{ __('Add social media profiles') }}"
            placeholder="{{ __('Select a social medium') }}"
            wire:model="mediaOptionSelected">
            @foreach ($mediaOptions as $option)
                <x-select.user-option src="{{ Storage::url($option->icon) }}" label="{{ $option->name}}" value="{{ $option->id }}" />
            @endforeach
        </x-select>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-3 mb-3 md:grid-cols-2">
        <x-input wire:model="userOnMedium" label="Your username on medium" placeholder="AccountName or URL addres" prefix="@ " />
        @if(App\Models\Medium::find($mediaOptionSelected))
            @if(Str::contains(App\Models\Medium::find($mediaOptionSelected)->url_structure, '#'))
            <x-input wire:model="serverOfMedium" label="Server of medium" placeholder="Server name" prefix="@ " />
            @endif
        @endif
    </div>

    <button wire:click.prevent="store()" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 hover:text-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-900 active:bg-gray-50 disabled:opacity-25 transition">{{__('Add') . ' ' .  __('Social Medium')}}</button>
            @if (session()->has('message'))
            <span x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition:leave.opacity.duration.1500ms>
                <span class="ml-3 text-sm text-gray-600">
                    {{ session('message') }}
                </span>
            </span>
            @endif

</form>