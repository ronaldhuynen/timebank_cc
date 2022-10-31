  <div x-data class="max-w-md mt-4">

      <label for="toAccount" class="my-2 block text-sm font-medium text-gray-700"> {{ __('To account') }}</label>

      <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 pt-2 flex pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
          </div>


          <!----- When no To account is selected ---->
          @if (!isset($toAccountId) || $search != '')

              <input
                wire:model.debounce.300ms="search"
                x-on:blur="$wire.checkRequired()"
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                placeholder="{{ __('Search name, email or account') }}"
                type="search"
                autocomplete="off">

                @if ($errorRequired)
                <div class="text-sm text-red-700 mb-3" role="alert">
                    {{ __('This field is required.') }}
                </div>
                @endif


              @if (strlen($search) > 2)
              <ul class="absolute z-50 bg-white border border-gray-300 w-full rounded-md mt-2 text-gray-700 text-sm divide-y divide-gray-200">
                  @forelse ($searchResults as $result)
                  <li>
                      <a wire:click="toAccountSelected({{ $result['accountId'] }})" class="flex items-center px-4 py-4 hover:bg-gray-200 transition ease-in-out duration-150">

                          {{-- <img src="{{ $result['artworkUrl60'] }}" alt="album art" class="w-10"> --}}
                          <div class="ml-4 leading-tight">
                              <div class="font-semibold">
                                  @if (array_key_exists('holderName', $result))
                                  {{ $result['holderName'] }}
                                  @else
                                  No account holder found
                                  @endif
                              </div>
                              <div class="text-gray-600">
                                  @if (array_key_exists('accountName', $result))
                                  {{ $result['accountName'] }}
                                  @else
                                  No accounts found
                                  @endif
                              </div>
                          </div>
                      </a>
                  </li>
                  @empty
                  <li class="px-4 py-4">No results found for "{{ $search }}"</li>
                  @endforelse
              </ul>
              @endif

                <!----- When a To account is selected ---->
                @else
                <input wire:model.debounce.300ms="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out" placeholder="" type="search" autocomplete="off">

                <div class=" w-full pl-0 pr-3 py-2 mt-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out">
                    {{-- <img src="{{ $result['artworkUrl60'] }}" alt="album art" class="w-10"> --}}
                    <div class="ml-4 leading-tight">
                        <div wire:model="toHolderName" class="font-semibold">
                            {{ $toHolderName }}
                        </div>
                        <div wire:model="toAccountName" class="text-gray-600">
                            {{ $toAccountName }}
                        </div>
                    </div>

                </div>
                @endif


            </div>
        </div>
      </div>
  </div>

