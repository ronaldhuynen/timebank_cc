<div class="mt-4 max-w-md" x-data>
    @if ($typeOptions)
        @foreach($typeOptions as $typeOption)
            <div class="flex items-start mb-2">
                <input type="radio" id="{{ 'transTypeRadio-' . $typeOption->id }}" name="transactionType" value="{{ $typeOption->name }}"
                       wire:model.live="transactionTypeSelected" class="form-radio h-4 w-4 transition duration-50 ease-in-out {{ $transactionTypeSelected === $typeOption->name ? 'text-gray-600' : 'text-gray-400' }}" />
                <label for="{{ 'transTypeRadio-' . $typeOption->id }}" class="ml-3 text-gray-900">{{ __($typeOption->label) }}</label>
            </div>
        @endforeach
    @endif
</div>