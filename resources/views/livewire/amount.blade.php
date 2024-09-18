<div>
    <style>
        input:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
    @isset($label)
        <x-jetstream.label :value="$label" for="amount" />
    @else
        <x-jetstream.label for="amount" value="{{ __('Amount of time') }}" />
    @endisset
    <div class="flex items-center">

        <span
              class="mt-1 block h-full rounded-l-md border-b border-l border-t border-gray-300 bg-white px-0 py-2 pl-3 text-sm">H
        </span>

        <!-- Hours input, max 4 integers -->
        <input class="@error('hours') is-invalid @enderror {{ $maxLengthHoursInput > 4 ? 'w-full' : 'w-14' }} mt-1 block border-l-0 border-r-0 border-gray-300 pr-2 text-right placeholder-gray-300 focus:border-gray-300 focus:outline-none sm:text-sm"
               maxlength="{{ $maxLengthHoursInput }}" min="0" name="hours"
               onblur="if(this.value === '') this.value = '0'"
               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, {{ $maxLengthHoursInput }})"
               placeholder="{{ __('hh') }}" step="1" type="text" value="{{ old('hours') }}"
               wire:model.blur.number="hours">
        <span class="mt-1 block h-full border-b border-t border-gray-300 bg-white px-0 py-2 text-sm">:</span>

        <!-- Minutes input, max 2 integers -->
        <input class="@error('minutes') is-invalid @enderror mt-1 block w-14 rounded-r-md border-l-0 border-gray-300 pl-2 text-left placeholder-gray-300 focus:border-gray-300 focus:outline-none sm:text-sm"
               max="60" maxlength="2" min="0" name="minutes"
               onblur="if(this.value === '') this.value = '00'; else if(this.value.length === 1) this.value = '0' + this.value"
               oninput="this.value = Math.min(59, Math.max(0, this.value.replace(/[^0-9]/g, '').slice(0, 2)))"
               placeholder="{{ __('mm') }}" step="1" type="text" value="{{ old('minutes') }}"
               wire:model.blur.number="minutes">
    </div>
</div>