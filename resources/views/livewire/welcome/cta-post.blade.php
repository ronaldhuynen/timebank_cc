<div class="bg-white">
<div class="py-24 px-28 -mt-6  bg-black ">
    @if($posts->isEmpty())
        <p class="text-gray-100 dark:text-gray-900">
            {{ __('No page available in your language at the moment') }}
        </p>
    @else
        @foreach($posts as $post)
            <div class="relative p-20 m-0">
                {{-- @if($post->hasMedia('*'))
                    <img src="{{ $post->getFirstMediaUrl('*') }}" alt="{{ $post->getFirstMedia('*')->getCustomProperty('caption') }}" class="w-screen h-auto mb-4">
                @endif --}}

                <!-- Title -->
                @if (isset($post->translations[0]) && isset($post->translations[0]->title))
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h2 class="text-gray-100 text-3xl font-semibold  dark:text-gray-900">
                            {{ $post->translations[0]->title }}
                        </h2>
                    </div>
                @endif
            </div>

            <!--  Content -->
            @if (isset($post->translations[0]) && isset($post->translations[0]->content))
                <div class="content  my-12 text-xl leading-loose  font-light text-center text-gray-100 dark:text-gray-900">{!! $post->translations[0]->content !!}
</div>
            @endif

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
</div>
<div>
<!-- CTA / Excerpt -->
@if (isset($post->translations[0]) && isset($post->translations[0]->excerpt))
    <div class="max-w-2xl mx-auto my-0 py-20 post bg-white">
        <div class="grid grid-cols-1 md:grid-cols-10 gap-2">
            <!-- Left Column (Content) -->
            <div class="md:col-span-7 text-gray-900">
                <div class="content text-base text-center leading-loose">
                    {{ $post->translations[0]->excerpt }}
                </div>
            </div>

            <!-- Right Column (Button) -->
            <div class="md:col-span-3 flex items-center justify-center">
                <button wire:click.prevent="register"
                    class="focus:shadow-outline-gray inline-flex items-center rounded-md border border-transparent bg-gray-900 px-6 py-2 text-base  font-semibold tracking-widest text-gray-100 hover:bg-black hover:text-white focus:border-gray-900 focus:outline-none active:bg-gray-950 disabled:opacity-25">
                    {{ __('Register now') }}
                </button>
            </div>
        </div>
    </div>
@endif
        @endforeach
    @endif
</div>