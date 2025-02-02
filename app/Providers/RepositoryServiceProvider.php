<?php

namespace App\Providers;

use App\Repositories\{Spotify, SpotifyContract};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind(SpotifyContract::class, Spotify::class);

    }
}
