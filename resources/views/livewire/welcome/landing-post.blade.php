<div class="w-full p-0 pt-6 m-0">
    @if($posts->isEmpty())
        <p class="text-gray-900 dark:text-gray-300">
            {{ __('No page available in your language at the moment') }}
        </p>
    @else
        @foreach($posts as $post)
            <div class="relative w-full p-0 m-0">
                @if($post->hasMedia('*'))
                    <img src="{{ $post->getFirstMediaUrl('*') }}" alt="{{ $post->getFirstMedia('*')->getCustomProperty('caption') }}" class="w-screen h-auto mb-4">
                @endif

                <!-- Title -->
                @if (isset($post->translations[0]) && isset($post->translations[0]->title))
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h2 class="text-3xl font-semibold text-gray-100 dark:text-white bg-opacity-100 bg-black p-6">
                            {{ $post->translations[0]->title }}
                        </h2>
                    </div>
                @endif
            </div>

            <!-- Intro / excerpt -->
            {{-- @if (isset($post->translations[0]) && isset($post->translations[0]->excerpt))
                <p class="text-lg my-12 leading-loose text-gray-800 dark:text-gray-300">{{ $post->translations[0]->excerpt }}</p>
            @endif --}}

            {{-- @if($post->hasMedia('*'))
                <div class="text-sm font-light mb-12 text-gray-800">
                    <div>
                        @if (isset($post->translations[0]))
                            {{ $post->getFirstMedia('*')->getCustomProperty('caption-' . $post->translations[0]->locale) }}
                        @endif
                    </div>
                    <div>
                        @if ($post->getFirstMedia('*')->getCustomProperty('owner'))
                            {{ __('Images by') . ' ' . $post->getFirstMedia('*')->getCustomProperty('owner') . '.'}}
                        @endif
                    </div>
                </div>
            @endif --}}

            <!-- Content -->
            @if (isset($post->translations[0]) && isset($post->translations[0]->content))
                <div class="text-gray-700 max-w-2xl mx-auto my-12 p-4 post mb-6 bg-white dark:bg-gray-700">
                    <div class="content font-base font-normal leading-loose">
                        {!! $post->translations[0]->content !!}
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>