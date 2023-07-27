<div>
{{-- {{dd($post)}} --}}
    @if ($post != null)

        <div class="border-b border-gray-200 bg-white p-6 sm:px-20">
            <div class="grid grid-cols-2 space-x-12">

                <div class="">
                    <div class="bg-black mb-2 px-2 py-1 text-xs font-semibold text-white">
                        {{ $post->category }}
                    </div>
                    <h1 class="mb-0 bg-black px-2 py-3 text-4xl font-bold text-white uppercase text-center">{{ $post->title }}</h1>
                    <div class="mb-0 px-4 text-base text-white md:mb-6 bg-black"> {{ $post->excerpt }}
                        <div class="mb-0 mt-6 flex justify-between ">
                            <span class="text-sm font-thin text-white">{{ $post->start . ' ' . __('by') }}
                                {{ $post->author }}
                            </span>
                            <div class="flex justify-end">
                                <a class="hidden font-bold text-white sm:block"
                                    href="{{ route('posts.show_by_slug', [$post->slug]) }}">{{ __('Read more') }}
                                </a>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="ml-2 h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 bg-black px-2 py-3 text-4xl font-bold text-white uppercase text-center">{{ Illuminate\Support\Carbon::parse($post->from)->isoFormat('dddd D MMM'); }}</div>

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
