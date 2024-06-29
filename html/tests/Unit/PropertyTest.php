<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{

    public function testPropertyPagination(): void
    {
        $response = $this->get('/api/properties?page=1');

        $this->assertTrue(true);

        $response->assertJsonCount(25, 'data');
    }

    public function testSearchByTitle(): void
    {
        $response = $this->get('/api/properties?title=Condo');
        $response->assertJsonCount(25, 'data');
    }

    public function testSearchByLocation(): void
    {
        $response = $this->get('/api/properties?location=Bangkok');
        $response->assertJsonCount(18, 'data');
    }

    public function testSearchByTitleAndLocation(): void
    {
        $response = $this->get('/api/properties?title=Condo&location=Bangkok');
        $response->assertJsonCount(25, 'data');
    }

    public function testSortPropertyByPrice(): void
    {
        $response = $this->get('/api/properties?sorting=price_desc');
        $response->assertJsonCount(25, 'data');
    }

    public function testSortPropertyByDate(): void
    {
        $response = $this->get('/api/properties?sorting=date_desc');
        $response->assertJsonCount(25, 'data');
    }

    public function testInvalidSearch()
    {
        $response = $this->get('/api/properties?property=12000');
        $response->assertStatus(422);
    }

    public function testUnexceptedDatabaseError()
    {
        $this->mock(Property::class, function ($mock) {
            $mock->shouldReceive('all')->andThrow(new \Exception('Database error'));
        });
        $response = $this->get('/api/properties');
        $response->assertStatus(500);
    }
}
