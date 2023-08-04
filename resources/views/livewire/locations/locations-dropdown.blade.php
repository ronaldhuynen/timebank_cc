<div>
    <div class="mb-6">
        <label class="rounder-md block text-sm font-medium text-gray-900"> {{ __('Country') }}</label>
        <select wire:model="country" wire:change="countrySelected"
            class="placeholder-gray-300 shadow-outline w-80 rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none">
            <option value="" selected>-- {{ __('Choose a country') }} --</option>
            @foreach ($countries->sortBy('locale.name') as $country)
                <option value={{ $country->id }}>{{ $country->flag . ' ' . $country->locale->name }}</option>
            @endforeach
        </select>
    </div>
    @if (count($cities) > 0)
        <div wire:init="countrySelected" class="mt-6 mb-6">
            <label class="rounder-md block text-sm font-medium text-gray-900">{{ __('City') }}</label>
            <select wire:model="city" wire:change="citySelected"
                class="placeholder-gray-300 shadow-outline w-80 rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none">
                <option value="" selected>-- {{ __('Choose a city') }} --</option>
                @foreach ($cities->sortBy('locale.name') as $city)
                    <option value={{ $city->id }}>{{ $city->locale->name }}</option>
                @endforeach
            </select>
        </div>
    @elseif (count($divisions) > 0 )
        <div wire:init="countrySelected" class="mt-6 mb-6">
            <label class="rounder-md block text-sm font-medium text-gray-900">{{ __('Division') }}</label>
            <select wire:model="division" wire:change="divisionSelected"
                class="placeholder-gray-300 shadow-outline w-80 rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none">
                <option value="" selected>-- {{ __('Choose a division') }} --</option>
                @foreach ($divisions->sortBy('locale.name') as $division)
                    <option value={{ $division->id }}>{{ $division->locale->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
