<div>
    <input wire:model="search" type="text" placeholder="Search...">
    <button wire:click="updatedSearch">Search</button>

    <!-- Display search results here -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Model</th>
                <th>ID</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($result['model'] === 'App\Models\User')
                    <a href="{{ route('user.show', ['userId' => $result['id']]) }}">{{ $result['model'] }}</a>
                    @elseif($result['model'] === 'App\Models\Organization')
                    <a href="{{ route('org.show', ['orgId' => $result['id']]) }}">{{ $result['model'] }}</a>
                    @elseif($result['model'] === 'App\Models\Post')
                    <a href="{{ route('post.show_by_id', ['postId' => $result['id']]) }}">{{ $result['model'] }}</a>
                    @else
                    {{ $result['model'] }}
                    @endif
                </td>
                <td>{{ $result['id'] }}</td>
                <td>{{ $result['score'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
