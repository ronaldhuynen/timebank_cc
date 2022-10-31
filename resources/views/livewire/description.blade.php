<div x-data class="max-w-md mt-4">

    <label for="description" class="mt-2 block text-sm font-medium text-gray-700"> {{ __('Description') }}</label>
    <textarea
        wire:model.lazy="description"
        x-on:blur="$wire.checkRequired()"
        placeholder=" {{ __('Payment description') }}"
        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
    </textarea>

    {{-- @if ($requiredError)
    <div class="text-sm text-red-700 mb-3" role="alert">
        {{ __('This field is required.') }}
    </div>
    @endif --}}

    {{-- @error('description')
    <div class="text-sm text-red-700 mb-3" role="alert">
        {{ __($message) }}
    </div>
    @enderror --}}

</div>
