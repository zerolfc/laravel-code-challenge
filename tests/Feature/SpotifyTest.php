<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\SpotifyContract;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SpotifyTest extends TestCase
{

    protected $spotify;

    protected function setUp(): void
    {

        parent::setUp();

        $this->spotify = app(SpotifyContract::class);

    }

    public function testSearchExpectGetMethod()
    {

        $this->get('/search')
        ->assertStatus(405);


    }

    public function testCatalog()
    {
        $response = $this->spotify->findCatalog('queen', ['track', 'artist', 'album']);

        $this->assertNotEmpty($response['tracks']);
        $this->assertNotEmpty($response['artists']);
        $this->assertNotEmpty($response['albums']);

    }

    public function testItemArtist()
    {

        $response = $this->spotify->findItem('artists', '1dfeR4HaWDbWqFHLkxsg1d');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('followers', $response);
        $this->assertArrayHasKey('name', $response);

        $this->assertContains('queen', strtolower($response['name']));
    }

    public function testItemAlbum()
    {

        $response = $this->spotify->findItem('albums', '6a8nlV9V8kPUbTTCJNVSsh');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('artists', $response);
        $this->assertArrayHasKey('name', $response);
    }

    public function testItemTrack()
    {

        $response = $this->spotify->findItem('track', '7tFiyTwD0nx5a1eklYtX2J');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('album', $response);
        $this->assertArrayHasKey('artists', $response);
        $this->assertArrayHasKey('name', $response);


    }

    public function testExceptionItem()
    {

        try {

            $this->spotify->findItem('music', '7tFiyTwD0nx5a1eklYtX2J');

        } catch (\Exception $e) {

            $this->assertEquals(
                new HttpException(400, 'Service not found'),
                $e
            );

        }

    }

}
