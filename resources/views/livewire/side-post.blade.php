<div>
        
        @if ($posts)
                    <div class="images my-3">
                @if ($thumbnail != null)
                        <img src="{{ $thumbnail }}">
            @endif
            </div>

        <div class="post">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                {{ $posts->translations[0]->title ?? '' }}
            </h3>
        </div>
        <div class="my-2 text-sm font-bold text-gray-600">
            {{ $posts->translations[0]->excerpt ?? '' }}
        </div>
        <div>
            <div class="text-sm text-gray-600">
                {!! $posts->translations[0]->content ?? '' !!}
            </div>
        </div>
        @endif
</div>
