<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class OpenBreweryAPIClient
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            // Configure Guzzle options if needed
        ]);
    }

    public function getBreweries()
    {
        $url = 'https://api.openbrewerydb.org/breweries';
        $response = $this->httpClient->get($url);

        return json_decode($response->getBody(), true);
    }

    public function getBrewery($id)
    {
        $url = 'https://api.openbrewerydb.org/breweries/' . $id;
        $response = $this->httpClient->get($url);

        return json_decode($response->getBody(), true);
    }
}
