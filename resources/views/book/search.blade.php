<div class="card">
    <div class="card-header"><b>{{ $searchResults->count() }} results found for "{{ request('query') }}"</b></div>
{{-- {{dd($searchResults)}} --}}
    <div class="card-body">

        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
            <h2>{{ ucfirst($type) }}</h2>

            @foreach($modelSearchResults as $searchResult)
                <ul>
                    <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                </ul>
            @endforeach
        @endforeach

    </div>
</div>


{{-- @if($books->isNotEmpty())
    @foreach ($books as $book)
        <div class="post-list">
            <p>{{ $book->title }}</p>
            <img src="{{asset('images/'.$book->portret)}}" style="width: 250px; height: auto;">
        </div>
    @endforeach
@else 
    <div>
        <h2>No posts found</h2>
    </div>
@endif --}}