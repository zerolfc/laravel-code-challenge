<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SpotifyContract;

class SearchController extends Controller
{

    private $spotify;

    public function __construct(SpotifyContract $spotify)
    {

        $this->spotify = $spotify;

    }

    public function index()
    {

        return view('index');
    }


    public function item(string $type, string $id)
    {

        try {
            $item = $this->spotify->findItem($type, $id);
        } catch (\Exception $e) {
            $item = '';
        }

        return view('item', compact('item'));

    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        $catalogs = $this->spotify->findCatalog($searchTerm, [
            'track', 'album', 'artist'
        ]);

        extract($catalogs);

        return view('search',
            compact('searchTerm', 'tracks', 'albums', 'artists')
        );
    }
}
