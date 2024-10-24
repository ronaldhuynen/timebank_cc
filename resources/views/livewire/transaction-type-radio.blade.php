<div class="mt-4 max-w-md" x-data>

    @if (in_array('work', $typeOptions))
        <x-radio id="transTypeRadio-1" label="{{ __('For the total time worked or helped') }}" value="work"
                 wire:model.live="transTypeRadio" />
    @endif
    @if (in_array('gift', $typeOptions))
        <x-radio id="transTypeRadio-2" label="{{ __('As a gift, without something in return') }}" value="gift"
                 wire:model.live="transTypeRadio" />
    @endif
    @if (in_array('donation', $typeOptions))
        <x-radio id="transTypeRadio-3" label="{{ __('As a donation, to support the cause of this organization') }}"
                 value="donation" wire:model.live="transTypeRadio" />
    @endif
    @if (in_array('currency creation', $typeOptions))
        <x-radio id="transTypeRadio-4" label="{{ __('Currency creation') }}" value="currency creation"
                 wire:model.live="transTypeRadio" />
    @endif
    @if (in_array('currency removal', $typeOptions))
        <x-radio id="transTypeRadio-5" label="{{ __('Currency removal') }}" value="currency removal"
                 wire:model.live="transTypeRadio" />
    @endif

</div>
