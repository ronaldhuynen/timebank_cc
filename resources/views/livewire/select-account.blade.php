{{-- Select account dropdown --}}
{{-- Source: https://chrisdicarlo.ca/blog/-alpinejs-and-livewire-autocomplete/?ref=laravelnews --}}

  <div class="max-w-md my-6">
      <label for="toAccount" class="block text-sm font-medium text-gray-700"> {{ __('To account') }}</label>

    <div x-data="{
      open: @entangle('showDropdown'),
      search: @entangle('search'),
      selected: @entangle('selected'),
      highlightedIndex: 0,
      highlightPrevious() {
        if (this.highlightedIndex > 0) {
          this.highlightedIndex = this.highlightedIndex - 1;
          this.scrollIntoView();
        }
      },
      highlightNext() {
        if (this.highlightedIndex < this.$refs.results.children.length - 1) {
          this.highlightedIndex = this.highlightedIndex + 1;
          this.scrollIntoView();
        }
      },
      scrollIntoView() {
        this.$refs.results.children[this.highlightedIndex].scrollIntoView({
          block: 'nearest',
          behavior: 'smooth'
        });
      },
      updateSelected(id, name) {
        this.selected = id;
        this.search = name;
        this.open = false;
        this.highlightedIndex = 0;
      },
  }">
        <div x-on:selected="updateSelected($event.detail.id, $event.detail.name)">
            <span>
                <div class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <input
                      placeholder="{{ __('Name, email or account name') }}"
                      class="w-full focus:ring-indigo-500 focus:border-indigo-500"
                      wire:model.debounce.300ms="search" x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                      x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                      x-on:keydown.enter.stop.prevent="$dispatch('selected', {
                        id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
                        name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                      })">
                </div>
            </span>

            <div class="py-2 px-3 col-span-6 sm:col-span-3 z-50 transition duration-150 ease-in-outrounded shadow-lg bg-white mt-1 border border-gray-200" x-show="open" x-on:click.away="open = false">


                <ul x-ref="results">
                    @forelse($results as $index => $result)
                    <li wire:key="{{ $index }}" x-on:click.stop="$dispatch('selected', {
                id: {{ $result['accountId'] }},
                name: '{{ $result['holderName'] . ' - ' . $result['accountName'] }}'
              })" :class="{
                'bg-black': {{ $index }} === highlightedIndex,
                'text-white': {{ $index }} === highlightedIndex
              }" data-result-id="{{ $result['accountId'] }}" data-result-name="{{ $result['holderName'] . ' - ' . $result['accountName'] }}">
                        <span>
                            {{ $result['holderName'] . ' - ' . $result['accountName'] . ' => ' . $result['accountId']}}
                        </span>
                    </li>


                    @empty
                    <li>{{ __('No results found')}}</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>


</div>


