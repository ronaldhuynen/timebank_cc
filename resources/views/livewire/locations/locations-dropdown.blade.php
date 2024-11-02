<div>
    <div class="mb-6">
        <label class="rounder-md block text-sm font-medium text-gray-900"> {{ __('Country') }}</label>
        <select class="shadow-outline w-80 rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight placeholder-gray-300 shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none"
                wire:change="countrySelected" wire:key="country-dropdown" wire:model.live="country">
            <option selected value="">-- {{ __('Choose a country') }} --</option>
            @foreach ($countries->sortBy(function ($country) {
        return $country->translations->first()->name;
    }) as $country)
                <option value="{{ $country->id }}">{{ $country->flag . ' ' . $country->translations->first()->name }}
                </option>
            @endforeach
        </select>
    </div>

    @if (count($cities) > 0)
        <div class="mb-6 mt-6" wire:init="countrySelected">
            <label class="rounder-md block text-sm font-medium text-gray-900">{{ __('City') }}</label>
            <select class="shadow-outline w-80 rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight placeholder-gray-300 shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none"
                    wire:change="citySelected" wire:key="city-dropdown" wire:model.live="city">
                <option selected value="">-- {{ __('Choose a city') }} --</option>
                @foreach ($cities->sortBy(function ($city) {
        return $city->translations->first()->name;
    }) as $city)
                    <option value="{{ $city->id }}">{{ $city->translations->first()->name }}</option>
                @endforeach
            </select>
        </div>
    @elseif (count($divisions) > 0)
        <div class="mb-6 mt-6" wire:init="countrySelected">
            <label class="rounder-md block text-sm font-medium text-gray-900">{{ __('Division') }}</label>
            <select class="shadow-outline w-80 rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight placeholder-gray-300 shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none"
                    wire:change="divisionSelected" wire:key="division-dropdown" wire:model.live="division">
                <option selected value="">-- {{ __('Choose a division') }} --</option>
                @foreach ($divisions->sortBy(function ($division) {
        return $division->translations->first()->name;
    }) as $division)
                    <option value="{{ $division->id }}">{{ $division->translations->first()->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
