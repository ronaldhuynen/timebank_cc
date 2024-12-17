<div class="w-full p-0 pt-6 m-0">
    @if($posts->isEmpty())
        <p class="text-gray-900 dark:text-gray-300">
            {{ __('No page available in your language at the moment') }}
        </p>
    @else
        @foreach($posts as $post)
            <div class="relative w-full p-0 m-0">
                @if($post->hasMedia('*'))
                    <img src="{{ $post->getFirstMediaUrl('*', 'hero') }}" alt="{{ $post->getFirstMedia('*')->getCustomProperty('caption') }}" class="w-screen h-auto mb-4">
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