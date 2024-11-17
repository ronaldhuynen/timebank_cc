<div class="mt-4 max-w-md" x-data>
    @if ($typeOptions)
    @foreach($typeOptions as $typeOption)
        <x-radio id="{{'transTypeRadio-' . $typeOption->id }}" label="{{ __($typeOption->label) }}" value="{{ $typeOption->name }}"
                wire:model.live="transactionTypeSelected" />
    @endforeach
    @endif
</div>
