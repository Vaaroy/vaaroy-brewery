<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BreweryTest extends TestCase
{
    use RefreshDatabase;
    
    public function testGetBreweries()
    {
        $response = $this->get('/api/breweries');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'type',
                'address' => [
                    'street',
                    'city',
                    'state',
                    'postal_code',
                ],
                'country',
                'phone',
                'website',
                'url',
            ],
        ]);
    }
}