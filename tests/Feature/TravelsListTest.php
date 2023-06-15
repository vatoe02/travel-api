<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Travel;

class TravelsListTest extends TestCase
{
   
    use RefreshDatabase;

   public function test_travels_list_returns_paginated_data_correctly(): void
    {
        $travel_info = Travel::factory(16)->create(['is_public' => true]);

        $response = $this->get('/api/v1/travels');
        //dd($response);
        $response->assertStatus(200);
        //$response->assertJsonCount(15, 'data');
        $response->assertJsonPath('meta.last_page', 1);
    }

    public function test_travels_list_shows_only_public_records()
    {
        $nonPublicTravel = Travel::factory()->create(['is_public' => false]);
        $publicTravel = Travel::factory()->create(['is_public' => true]);
        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        //$response->assertJsonFragment(['id' => $publicTravel->id]);
        //$response->assertJsonMissing(['id' => $nonPublicTravel->id]);

    }
}
