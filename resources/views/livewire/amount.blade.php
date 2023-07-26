<div class="max-w-md mt-0">
    <label for="amount" class="block text-sm font-medium text-gray-900">{{ __('Amount') }}</label>
        <input wire:model.lazy="amount" type="text" min="0.01" step="0.01" placeholder="00:00" class="mt-1 placeholder-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
    </label>

    {{-- TODO: Make amount of more than 99:99 possible
    <x-inputs.maskable
        wire:model.lazy="amount"
        label="{{ __('Amount') }}"
        mask="##:##"
        emitFormatted="true"
        placeholder="00:00"
        name="amount"
        min="0.01"
        step="0.01"
        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('amount') is-invalid @enderror"
        value="{{ old('amount') }}" /> --}}
</div>
