<div class="grid grid-cols-2 gap-8">

    @foreach($items as $item)

    <a href="{{ route('item', [$item['type'],$item['id']]) }}">

        <div class="flex">
            <section class="w-28 mr-3">
            @if($slot == 'track')

                <img src="{{ $item['album']['images'][0]['url'] ?? asset('img/no-img.jpg') }}" class="bg-white rounded shadow-lg shadow-green-500/20 w-full aspect-square object-cover" alt="{{ $item['album']['name'] }}" loading="lazy" />


            @else

                <img src="{{ $item['images'][0]['url'] ?? asset('img/no-img.jpg') }}" class="bg-white rounded shadow-lg shadow-green-500/20 w-full aspect-square object-cover" alt="{{ $item['name'] }}" loading="lazy" />


            @endif
            </section>
            <section>
                <div class="font-bold">{{ $item['name'] }}</div>

                @if($slot == 'album')

                <div class="text-gray-400 text-sm">{{ date('Y', strtotime($item['release_date'])) }} &middot; {{ $item['artists'][0]['name'] }}</div>
                <div class="text-gray-400 text-sm">{{ $item['total_tracks'] }} Tracks</div>

                @elseif($slot == 'artist')

                <div class="text-gray-400 text-sm">{{ number_format($item['followers']['total']) }} Followers</div>

                @elseif($slot == 'track')

                <div class="text-gray-400 text-sm">Artist: {{ $item['artists'][0]['name'] }}</div>
                <div class="text-gray-400 text-sm">Album: {{ $item['album']['name'] }}</div>
                <div class="text-gray-400 text-sm">Track: {{ $item['track_number'] }}</div>


                @endif


            </section>
        </div>


    </a>

    @endforeach
</div>
