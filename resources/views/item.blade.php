<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="h-full p-10">

        <div class="flex justify-center">

        @if(!$item)
            <p class="text-red-800">No item found!</p>
        @else

            <div class="border w-96 shadow-lg shadow-green-500/20 rounded overflow-hidden">

            @if($item['type'] == 'track')

            <img src="{{ $item['album']['images'][0]['url'] }}" class="object-cover w-full" alt="{{ $item['album']['name'] }}" loading="lazy" />

                @isset($item['preview_url'])

                    <figure class="flex justify-center mt-5">
                        <audio controls src="{{ $item['preview_url'] }}"></audio>
                    </figure>

                @endisset

            @else

            <img src="{{ $item['images'][0]['url'] }}" class="object-cover w-full" alt="{{ $item['name'] }}" loading="lazy" />

            @endif

            <div class="p-5">

            <h1 class="text-2xl font-bold">{{ $item['name'] }}</h1>

            @if($item['type'] == 'album')

                <div class="text-sm text-gray-400">{{ date('Y', strtotime($item['release_date'])) }} &middot; {{ $item['artists'][0]['name'] }}</div>
                <div class="text-sm text-gray-400">{{ $item['total_tracks'] }} Tracks</div>

            @elseif($item['type'] == 'artist')

                <div class="text-sm text-gray-400">{{ number_format($item['followers']['total']) }} Followers</div>

                @if($item['genres'])
                <div class="text-sm text-gray-400">Genres: {{ implode(', ', $item['genres']) }}</div>
                @endif

            @else

                <div class="text-gray-400 text-sm">Artist: {{ $item['artists'][0]['name'] }}</div>
                <div class="text-gray-400 text-sm">Album: {{ $item['album']['name'] }}</div>
                <div class="text-gray-400 text-sm">Track: {{ $item['track_number'] }}</div>
                <div class="text-gray-400 text-sm">Duration: {{ date('H:i:s', $item['duration_ms'] / 1000) }}</div>

            @endif


            @isset($item['external_urls']['spotify'])

            <a href="{{ $item['external_urls']['spotify'] }}" class="bg-green-600 inline-flex text-white rounded px-3 h-10 items-center mt-5 hover:bg-green-700" target="_blank" title="Open in Spotify">Open In Spotify</a>

            @endif

            </div>


            </div>

            @endif


        </div>

    </div>
</body>
</html>

