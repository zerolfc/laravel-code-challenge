<?php

namespace App\Repositories;

use App\Repositories\SpotifyContract;
use Cache, Str;
use GuzzleHttp\Client as Http;
use GuzzleHttp\Exception\RequestException;


class Spotify implements SpotifyContract {

    private $http;

    public function __construct()
    {

        $this->http = new Http;

    }

    /**
     * Find Spotify item
     *
     * @param string $type
     * @param string $id
     * @return Array
     */
    public function findItem(string $type, string $id) : Array
    {

        return $this->_request(
            config('services.spotify.api_url') . '/' . Str::plural($type) . '/' . $id,
            'GET',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->_token()
                ]
            ]
        );


    }


    /**
     * Find Spotify catalog
     *
     * @param string $string
     * @param array $types
     * @return Array
     */
    public function findCatalog(string $string, array $types) : Array
    {

        return $this->_request(
            config('services.spotify.api_url') . '/search',
            'GET',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->_token()
                ],
                'query' => [
                    'q' => $string,
                    'type' => implode(',', $types)
                ],
            ]
        );

    }


    /**
     * Access token
     *
     * @return String
     */
    private function _token() : String
    {

        $baseString = base64_encode(
            config('services.spotify.id').':'.config('services.spotify.secret')
        );

        $response = $this->_request(
            config('services.spotify.account_url'),
            'POST',
            [
                'headers' => [
                    'Authorization' => 'Basic ' . $baseString
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]
        );

        return $response['access_token'];


    }

    /**
     * Request & cache results to improve speed
     *
     * @param string $uri
     * @param string $method
     * @param array $options
     * @return Array
     */
    private function _request(string $uri, string $method, array $options = []) : Array
    {

        $cacheName = md5(__METHOD__.$uri.$method.json_encode($options));

        try {

            if ($response = Cache::get($cacheName)) {
                return $response;
            }

            $response = $this->http->request($method, $uri, $options);

            $response = json_decode($response->getBody(), true);

            Cache::put(
                $cacheName,
                $response,
                3600
            );

            return $response;

        } catch (RequestException $e) {

            $msg = 'Bad request';

            if ($e->hasResponse()) {

                $e = json_decode((string) $e->getResponse()->getBody(), true);

                $msg = $e['error']['message'] ?? $e['error'] ?? $msg;
            }

            abort(400, $msg);
        }


    }


}
