<div>
@if($post != null)

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="grid grid-cols-2 space-x-12">
        <div class="">
        <div class="p-2 text-xs font-semibold text-white bg-black">
            {{ $post['category']}}
        </div>
        <h1 class=" text-white bg-black p-2 font-bold text-2xl my-2">{{ $post['title']}}</h1>
        <p class="text-gray-600 mb-2 md:mb-6 text-base"> {{ $post['excerpt']}}</p>
        <div class="flex justify-between mb-2 mt-6">
            <span class="font-thin text-sm text-gray-500">{{ $post['published_at'] . ' ' . __('by')}} {{ $author['name']}}</span>
            <span class="sm:block hidden mb-2 text-gray-900 font-bold">{{ __('Read more') }}...</span>
        </div>
        </div>

        <div class="grid grid-cols-1 place-items-end">
        {{-- <img class="bg-cover min-w-max " src="{{$images}}" alt="" />--}}
                    <div class="w-full h-full bg-cover" style="background-image: url(https://images.unsplash.com/photo-1508394522741-82ac9c15ba69?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=748&q=80)">
                <div class="w-full h-full bg-black opacity-25"></div>
            </div>
        </div>

        </div>
    </div>

@endif
<div>