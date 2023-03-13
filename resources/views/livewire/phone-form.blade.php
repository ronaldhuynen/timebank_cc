<div>

        {{-- {{ dump($phoneCodeOptions->flag)}} --}}

            <x-jet-label for="email" value="{{ __('Phone') . ' ' . __('(only visible for friends)') }}" />
    <div class="flex">
        <x-native-select
            id="phoneCode"
            wire:model="phonecode"
            :options="$phoneCodeOptions"
            option-value="code"
            option-label="label">
        </x-native-select>

        <x-input
        id="phone"
            placeholder="6 1234 5678"
            wire:model="phone" />
    </div>
</div>
