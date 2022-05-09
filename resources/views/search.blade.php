<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="h-full p-10">
    <div class="mb-10">
        Your Search Term Was: <b>{{$searchTerm}}</b>
    </div>

    <div class="text-2xl font-bold text-green-600 mb-5 bg-green-50 px-5 py-1 border-b border-green-400 rounded">Albums</div>

    @if(!count($albums['items']))
        <p class="text-red-800">No album found!</p>
    @else

        @items(['items' => $albums['items']])
        album
        @enditems

    @endif

    <div class="text-2xl font-bold text-green-600 mb-5 mt-20 px-5 py-1 bg-green-50 border-b border-green-400 rounded">Artists</div>



    @if(!count($artists['items']))
    <p class="text-red-800">No artist found!</p>
    @else

    @items(['items' => $artists['items']])
    artist
    @enditems

    @endif



    <div class="text-2xl font-bold text-green-600 mb-5 mt-20 px-5 py-1 bg-green-50 border-b border-green-400 rounded">Tracks</div>


    @if(!count($tracks['items']))
    <p class="text-red-800">No track found!</p>
    @else

    @items(['items' => $tracks['items']])
    track
    @enditems

    @endif

    <br>


</div>
</body>
</html>
