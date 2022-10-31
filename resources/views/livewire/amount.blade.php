<div class="max-w-md mt-4">
    <label for="amount" class="block text-sm font-medium text-gray-700">{{ __('Amount') }}</label>
        <input wire:model.lazy="amount" type="text" min="0.01" step="0.01" placeholder="00:00" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
    </label>

</div>
