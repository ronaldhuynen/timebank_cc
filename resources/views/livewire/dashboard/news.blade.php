<div>
@if($post != null)

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div class="grid grid-cols-2 space-x-12">
            <div class="">
            <div class="px-2 py-1 text-xs font-semibold text-white bg-black">
                {{ $post->category}}
            </div>
            <h1 class=" text-white bg-black px-2 py-1 font-bold text-2xl my-2">{{ $post->title }}</h1>
            <p class="text-gray-600 mb-2 md:mb-6 text-base"> {{ $post->excerpt }}</p>
                <div class="flex justify-between mb-2 mt-6">
                    <span class="font-thin text-sm text-gray-500">{{ $post->start . ' ' . __('by')}} {{ $author }}</span>
                    <div class="flex justify-end">
                        <a class="sm:block hidden mb-2 text-gray-900 font-bold" href="{{ route('posts.show_by_slug', [$post->slug]) }}">{{ __('Read more') }}<a>
                    <div class="ml-1 mt-1">
                                <svg viewBox="0 0 20 20" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </div>
                    </div>
                </div>
            </div>

            @if($media != null)
            <div class="grid grid-cols-1 place-items-end">
                <div class=" w-full h-full">
                {{ $media('4_3') }}
                {{-- TODO: move caption to single post page --}}
                    {{-- <div class="w-full h-full bg-black opacity-25 text-white text-3xs pr-1 text-right">{{ $images['caption'] }}</div> --}}
                </div>
            </div>
            @endif

        </div>
    </div>

@endif
<div>