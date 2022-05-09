<?php

namespace App\Repositories;

interface SpotifyContract {

    public function findItem(string $type, string $id) : Array;

    public function findCatalog(string $string, array $types) : Array;

}
