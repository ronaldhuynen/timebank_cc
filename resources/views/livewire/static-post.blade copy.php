<div class="max-w-4xl mx-auto my-12 p-4">
    @if($posts->isEmpty())
        <p class="text-gray-900 dark:text-gray-300">
            {{ __('No page available in your language at the moment') }}
        </p>
    @else
        @foreach($posts as $post)
                
                <!-- Title -->
                @if (isset($post->translations[0]->title))
                <h2 class="text-3xl font-semibold my-12 text-gray-900 dark:text-white">{{ $post->translations[0]->title }}</h2>
                @endif
                <!-- Intro / excerpt -->
                @if (isset($post->translations[0]->excerpt))
                <p class="text-lg my-12 leading-loose text-gray-800 dark:text-gray-300">{{ $post->translations[0]->excerpt }}</p>
                @endif
                @if($post->hasMedia('*'))
                    <img src="{{ $post->getFirstMediaUrl('*') }}" alt="{{ $post->getFirstMedia('*')->getCustomProperty('caption') }}" class="w-full h-auto mb-4">
                    <div class="text-sm font-light mb-12 text-gray-800">
                    <div>
                    {{ $post->getFirstMedia('*')->getCustomProperty('caption-' . $post->translations[0]->locale) }}
                    </div>
                    <div>
                    @if ($post->getFirstMedia('*')->getCustomProperty('owner'))
                    {{ __('Images by') . ' ' . $post->getFirstMedia('*')->getCustomProperty('owner') . '.'}}
                    @endif
                    </div>
                
                @endif
                
                <!-- Content --->
                <div class="text-gray-700 max-w-2xl mx-auto my-12 p-4 post mb-6 bg-white dark:bg-gray-700">
                @if (isset($post->translations[0]->content))
                    <div class="content font-base font-normal leading-loose">
                        {!! $post->translations[0]->content !!}
                    </div>
                @endif
                </div>
            @php
                $update = Illuminate\Support\Carbon::createFromTimeStamp(strtotime($post->translations[0]->updated_at))->isoFormat('LL');
            @endphp
            <div class="text-sm font-light mb-12 text-gray-800">
            {{ __('Written by') . ' ' . config('timebank-cc.posts.site-content-writer') . ' ' . __('on') . ' ' . $update }}
            </div>
        @endforeach

    @endif
</div>