<div>
    <div class="my-6">
        <div class="flex justify-between py-1">
            <span class="text-gray text-sm">{{ __('Account usage') }}</span>
        </div>
        <svg class="rc-progress-line" preserveAspectRatio="none" viewBox="0 0 100 1">
            <path class="rc-progress-line-trail" d="M 0.5,0.5 L 99.5,0.5" fill-opacity="0" stroke-linecap="round" stroke-width="1" stroke="#D9D9D9"></path>
            
            <!-- Path for the part up to 80% -->
            <path class="rc-progress-line-path" d="M 0.5,0.5 L {{ min($balancePct, 80) }}.5,0.5" fill-opacity="0" stroke-linecap="round" stroke-width="1" stroke="#000000"
                  style="stroke-dasharray: {{ min($balancePct, 80) }}px, 100px; stroke-dashoffset: 0px; transition: stroke-dasharray 0.5s ease, stroke 0.5s ease; ">
            </path>
            
            <!-- Path for the part over 80% -->
            @if ($balancePct > 80)
                <path class="rc-progress-line-path" d="M 80.5,0.5 L {{ $balancePct }}.5,0.5" fill-opacity="0" stroke-linecap="round" stroke-width="1" stroke="#ef4444"
                      style="stroke-dasharray: {{ $balancePct - 80 }}px, 100px; stroke-dashoffset: 0px; transition: stroke-dasharray 0.5s ease, stroke 0.5s ease; transition-delay: 0.5s ;
">
                </path>
            @endif
        </svg>
        <div class="flex justify-between py-1">
            <span class="text-gray text-sm">{{ tbFormat($selectedAccount['balance']) . ' ' . __('of') . ' ' . tbFormat($selectedAccount['limitMax']) . ' ' . __('used') }}</span>
            @if ($balancePct > 80)
                <span class="text-gray text-sm">{{ tbFormat($selectedAccount['available']) . ' ' . __('available') }}</span>
            @endif
        </div>
    </div>
</div>