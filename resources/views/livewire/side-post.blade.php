<div>
    @forelse ($posts as $post)
    <div class="post">
            <h2>{{ $post->translations->first()->title }}</h2>
            <p>{{ $post->translations->first()->excerpt }}</p>
             <p>{{ $post->translations->first()->content }}</p>
            <div class="images">
                @foreach ($post->images as $image)
                    <img src="{{ Storage::url($image->path) }}" alt="{{ $image->caption }}">
                @endforeach
            </div>
            <div class="category">
                {{ $post->category->name }}
            </div>
        </div>
    @empty
    no post
    @endforelse
</div>
