<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Services\OpenBreweryAPIClient;

class BreweryController extends Controller
{
    protected $apiClient;

    public function __construct(OpenBreweryAPIClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }
    public function index()
    {
       // $response = Http::get('https://api.openbrewerydb.org/breweries');
       // $breweries = $response->json();

       //Using API client to fetch breweries
       $breweries = $this->apiClient->getBreweries();

        $transformedBreweries = [];

        foreach ($breweries as $brewery) {
            $transformedBrewery = $this->transformBrewery($brewery);
            $transformedBrewery['url'] = route('breweries.show', ['brewery' => $brewery['id']]);
            $transformedBreweries[] = $transformedBrewery;
        }

        return $transformedBreweries;
    }

    public function show($id)
    {
       // $response = Http::get("https://api.openbrewerydb.org/breweries/{$brewery}");
       // $brewery = $response->json();

       //Using API client to fetch brewerY
       $brewery = $this->apiClient->getBrewery($id);

        $transformedBrewery = $this->transformBrewery($brewery);

        return $transformedBrewery;
    }

    private function transformBrewery($brewery)
    {
        return [
            'id' => $brewery['id'],
            'name' => $brewery['name'],
            'type' => $brewery['brewery_type'],
            'address' => [
                'street' => $brewery['street'],
                'city' => $brewery['city'],
                'state' => $brewery['state'],
                'postal_code' => $brewery['postal_code'],
            ],
            'country' => $brewery['country'],
            'phone' => $brewery['phone'],
            'website' => $brewery['website_url'],
        ];
    }
}
 