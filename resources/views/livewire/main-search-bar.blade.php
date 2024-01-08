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
                <th>Highlight</th>
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
                <td>
                TODO: format html in controller to escape xss vulnerabilities and to sort relevance of highlight
                    @foreach($result['highlight'] as $highlight)
                    {!! $highlight !!} <br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
        Results: <span class="font-extrabold italic"> {{ count($results) }} </span>
    </table>
</div>