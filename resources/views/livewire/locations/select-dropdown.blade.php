<div>
    <div class="mb-8">
        <label class="rounder-md block text-sm font-medium text-gray-700"> {{ __('Country') }}</label>
            <select wire:model="country"
                class="w-80 shadow-outline rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none">
                <option disabled>{{ __('Choose a country') }}</option>
                @foreach ($countries as $country)
                    <option value={{ $country->country_id }}>{{ $country->name}}</option>
                @endforeach
            </select>
    </div>

    @if (count($cities) > 0)
        <div class="mb-8">
            <label class="rounder-md block text-sm font-medium text-gray-700">{{ __('City') }}</label>
            <select wire:model="city"
                class="w-80 shadow-outline rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none">
                <option disabled>{{ __('Choose a city') }}</option>
                @foreach ($cities as $city)
                    <option value={{ $city->city_id }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if (count($districts) > 0)
        <div class="mb-8">
            <label class="rounder-md block text-sm font-medium text-gray-700">{{ __('District') }}</label>
            <select wire:model="district"
                class="w-80 shadow-outline rounded border border-gray-400 bg-white p-2 px-4 py-2 pr-8 leading-tight shadow-md hover:border-gray-500 focus:appearance-none focus:outline-none">
                <option disabled>{{ __('Choose a district') }}</option>
                @foreach ($districts as $district)
                    <option value={{ $district->district_id }}>{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

</div>
