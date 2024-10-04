<div>
    <!-- Display search results here -->
    <section class="">
            <div class="grid w-full grid-cols-1 gap-0 md:grid-cols-3">
                    @foreach ($results as $result)
                <div wire:click="showProfile('{{ $result['id'] }}', '{{ class_basename($result['model']) }}')" class="border-b border-gray-400 px-8 py-6 md:border-r cursor-pointer">

                    <div class="mb-4 flex items-start justify-between gap-6">
                    @if ($result['status'] == 'online')
                    <img class="h-28 w-28 flex-shrink-0 rounded-full object-cover ring-4 ring-green-400 sm:mx-4"
                            src="{{ Storage::url($result['photo']) }}" title="{{__('Online')}}"/>
                    @elseif ($result['status'] == 'away')
                    <img class="h-28 w-28 flex-shrink-0 rounded-full object-cover ring-4 ring-sky-400 sm:mx-4"
                            src="{{ Storage::url($result['photo']) }} title="{{__('Away')}}/>
                    @else
                    <img class="h-28 w-28 flex-shrink-0 rounded-full object-cover ring-2 ring-gray-100 sm:mx-4"
                            src="{{ Storage::url($result['photo']) }}" />
                    @endif
                        
                        <div class="flex-grow text-gray-700">
                            <div class="flex gap-4">
                                <p class="mb-1 flex-grow text-xl font-black">{!! $result['title'] !!}</p>
                                <p class="cursor-default text-lg" title="{{ $result['location'] }}">
                                    <span class="flex items-center">
                                        <svg aria-label="location pin icon" class="h-5 w-5 pt-1 fill-current"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z" />
                                        </svg>
                                        <p class="text-lg" title="{{ $result['location'] }}">{{ $result['location_short'] }}</p>
                                    </span>
                                </p>
                            </div>
                            <p class="text-base font-normal text-gray-900">{!! $result['subtitle'] !!}</p>
                        </div>
                    </div>
                    <div class="flex place-items-end gap-6">
                        <p class="flex-grow text-xl text-gray-600">
                            @foreach (collect($result['highlight'])->unique()->toArray() as $highlight)
                               <span class="flex-shrink-0 rounded bg-gray-100 px-2 py-1 mx-2 text-gray-900">
                                {!! $highlight !!}
                                 </span>
                            @endforeach
                        </p>
                        {{-- <p class="flex-shrink-0 text-lg">
                        {{ $result['location'] }}
                        </p> --}}
                    </div>

                </div>
        @endforeach
                    </div>

    </section>

</div>
