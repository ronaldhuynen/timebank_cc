<div x-data="{ open: false }" class="max-w-md mt-4">


    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 pt-2 flex pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="flex">
            <input 
                wire:model.debounce.150ms="search" 
                wire:keydown.enter="showSearchResults('{{ $search }}')"
                x-on:focus="open = true" 
                x-on:input="open = true"
                x-on:keydown.enter="open = false"
                x-on:click.away="open = false" 
                type="search" placeholder="{{ __('Search...')}}" 
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm leading-5 bg-white placeholder-gray-300 focus:placeholder-gray-700 focus:border-indigo-300 sm:text-sm transition duration-150 ease-in-out" placeholder="{{ __('Search name, skill or keyword') }}" 
                autocomplete="off">
            <button wire:click="showSearchResults('{{ $search }}')">{{ __('Search') }}</button>
        </div>

        @if (strlen($search) > 3 )
        <ul x-show="open" class="cursor-pointer absolute z-50 bg-white border border-gray-300 w-full shadow-lg rounded-md text-gray-900 text-sm">
            @forelse ($suggestions as $suggestion)
            <li>
                {{-- <img src="{{ $result['holderPhoto'] }}" class="w-10 rounded-full"> --}}
                <div class="m-2">
                    <ul class="font-semibold text-gray-900">
                        @if ($suggestion)
                        <a wire:click="showSearchResults('{{ $suggestion }}')" class="flex items-center px-1 py-1">{{ $suggestion }}</a>
                        @else
                        {{ __('No results found') }}
                        @endif
                    </ul>
                </div>
            </li>
            @empty
            <li class="px-4 py-4">{{ __('No results found for') }} "{{ $search }}"</li>
            @endforelse
        </ul>
        @endif

        @if($showResults)
        <!-- Display search results here -->
        <label for="mainSearchBar" class="my-2 block text-sm font-medium text-gray-900">
            {{ count($results) . ' ' . __('results') }}
        </label>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Model</th>
                    <th>ID</th>
                    <th>Score</th>
                    <th>Highlight</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td></td>
                    <td>
                        @if($result['model'] === 'App\Models\User')
                        <a href="{{ route('user.show', ['userId' => $result['id']]) }}">{{ $result['model'] }}</a>
                        @elseif($result['model'] === 'App\Models\Organization')
                        <a href="{{ route('org.show', ['orgId' => $result['id']]) }}">{{ $result['model'] }}</a>
                        @elseif($result['model'] === 'App\Models\Post')
                        <a href="{{ route('post.show_by_id', ['postId' => $result['id']]) }}">{{ $result['model'] }}</a>
                        @else
                        {{ $result['model'] }}
                        @endif
                    </td>
                    <td>{{ $result['id'] }}</td>
                    <td>{{ $result['score'] }}</td>
                    <td>
                        {{-- TODO: format html in controller to escape xss vulnerabilities and to sort relevance of highlight by exclsuing words that are not in the search query --}}
                        @foreach($result['highlight'] as $highlight)
                        {!! $highlight !!} <br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>