<div class="mt-4 max-w-md" x-data="{ open: false }">

  @isset($label)
        <x-jetstream.label :value="$label" for="toAccount" />
    @else
        <x-jetstream.label for="toAccount" value="{{ __('To account') }}" />
    @endisset

    <div class="relative">

        <!----- When no To account is selected ----->
        @if (!isset($toAccountId) || $search != '')
            <div class="pointer-events-none absolute inset-y-0 left-0 flex pl-3 pt-2">
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path clip-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          fill-rule="evenodd" />
                </svg>
            </div>
            <input 
                    id="searchInput"
                    autocomplete="off"
                   class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:placeholder-gray-700 sm:text-sm"
                   placeholder="{{ __('Search name or account') }}" type="search"
                   wire:model.live.debounce.500ms="search" x-on:blur="$wire.checkValidation()"
                   x-on:click.away="open = false" x-on:focus="open = true">

            @if (strlen($search) > 2)
                <ul class="absolute z-50 overflow-visible mt-0 w-full cursor-default rounded-md border border-gray-300 bg-white text-sm text-gray-900 shadow-lg"
                    x-show="open">
                    @forelse ($searchResults as $result)
                        <li>
                            <a class="flex items-center px-2 py-2 hover:bg-gray-100"
                               wire:click="toAccountSelected({{ $result['accountId'] }})">
                                <img class="w-10 rounded-full" src="{{ $result['holderPhoto'] }}">
                                <div class="ml-4 leading-tight">
                                    <div class="font-semibold text-gray-900">
                                        @if (array_key_exists('holderName', $result))
                                            {{ $result['holderName'] }}
                                        @else
                                            {{ __('No account holder found') }}
                                        @endif
                                    </div>
                                    <div class="text-gray-600">
                                        @if (array_key_exists('accountName', $result))
                                            {{ $result['accountName'] }}
                                        @else
                                            {{ __('No accounts found') }}
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-4 py-4">{{ __('No results found for') }} "{{ $search }}"</li>
                    @endforelse
                </ul>
            @endif

        <!----- When a To account is selected ---->
        @else
            <div
                 class="focus:shadow-outline-blue mt-2 w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-0 pr-3 leading-5 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:placeholder-gray-300 focus:outline-none sm:text-sm">
                <!-- Add cursor-default class here -->
                <div class="flex items-center pl-2">
                    <img class="w-10 rounded-full" src="{{ $toHolderPhoto }}">
                    <div class="ml-4 leading-tight">
                        <div class="font-semibold" wire:model.live="toHolderName">
                            {{ $toHolderName }}
                        </div>
                        <div class="text-gray-600" wire:model.live="toAccountName">
                            {{ $toAccountName }}
                        </div>
                    </div>
                    <button type="button" class="ml-auto text-gray-600 hover:text-red-600" wire:click="removeSelectedAccount">
                        <x-icon class="h-5 w-5" name="x-circle" />
                    </button>
                </div>
            </div>
        @endif

    </div>
{{-- 
Script to raise focus on searchInput when $search already exsists during page load. 
This is for the 'pay-to-name' route where the account holder's name is set in the url.
The user should verify the name and account in the payment form. 
--}}
<script>
    window.onload = function() {
        var searchInput = document.getElementById('searchInput');
        if (searchInput && searchInput.value) {
            searchInput.focus();
        }
    };
</script>
</div>
