<div>
    @if ($post != null)

        <div class="border-b border-gray-200 bg-white p-6 sm:px-20">
            <div class="grid grid-cols-2 space-x-12">

                <div class="">
                    <div class="bg-black px-2 py-1 text-xs font-semibold text-white">
                        {{ $post->category }}
                        {{ $post->id}}
                    </div>
                    <h1 class="my-2 bg-black px-2 py-1 text-2xl font-bold text-white">{{ $post->title }}</h1>
                    @if (isset($post->excerpt))
                        <div class="mb-2 text-base text-gray-600 md:mb-6"> {{ $post->excerpt }}</div>
                    @endif
                    <div class="mb-2 mt-6 flex justify-between">
                        <span class="text-sm font-thin text-gray-500">{{ $post->start . ' ' . __('by') }}
                            {{ $post->author }}
                        </span>
                        <div class="flex justify-end">
                            <a class="mb-2 hidden font-bold text-gray-900 sm:block"
                                href="{{ route('post.show_by_slug', [$post->slug]) }}">{{ __('Read more') }}
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="ml-2 h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                @if ($media != null)
                    <div class="grid grid-cols-1 place-items-end">
                        <div class="h-full w-full">
                            {{ $media('4_3') }}
                        </div>
                    </div>
                @endif

            </div>
        </div>

    @endif
    <div>
