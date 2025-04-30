<?php

namespace Tests\Feature;

use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Mockery;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    public function test_index_returns_paginated_vehicles()
    {
        $mockService = Mockery::mock(VehicleService::class);
        $this->app->instance(VehicleService::class, $mockService);

        $vehicles = Vehicle::factory()->count(3)->create();
        Request::create('/api/v1/vehicles', 'GET');

        $mockService->shouldReceive('getVehiclesFiltered')
            ->once()
            ->with(Mockery::type(Request::class))
            ->andReturn($vehicles);

        $response = $this->getJson('/api/v1/vehicles');

        $response->assertOk();
    }

    public function test_store_returns_created_vehicle()
    {
        $mockService = Mockery::mock(VehicleService::class);
        $this->app->instance(VehicleService::class, $mockService);

        $payload = Vehicle::factory()->make()->toArray();

        $vehicle = new Vehicle($payload);

        $mockService->shouldReceive('create')
            ->once()
            ->andReturn($vehicle);

        $response = $this->postJson('/api/v1/vehicles', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['brand' => $vehicle->brand]);
    }

    public function test_show_returns_vehicle()
    {
        $mockService = Mockery::mock(VehicleService::class);
        $this->app->instance(VehicleService::class, $mockService);

        $vehicle = Vehicle::factory()->create();

        $mockService->shouldReceive('getById')
            ->once()
            ->with($vehicle->id)
            ->andReturn($vehicle);

        $response = $this->getJson("/api/v1/vehicles/{$vehicle->id}");

        $response->assertOk()
            ->assertJsonFragment(['brand' => $vehicle->brand]);
    }

    public function test_update_returns_updated_vehicle()
    {
        $mockService = Mockery::mock(VehicleService::class);
        $this->app->instance(VehicleService::class, $mockService);

        $vehicle = Vehicle::factory()->create();
        $updatedData = Vehicle::factory()->make()->toArray();

        $mockService->shouldReceive('update')
            ->once()
            ->andReturn(new Vehicle($updatedData));

        $response = $this->putJson("/api/v1/vehicles/{$vehicle->id}", $updatedData);

        $response->assertOk()
            ->assertJsonFragment(['brand' => $updatedData['brand']]);
    }

    public function test_destroy_returns_no_content()
    {
        $mockService = Mockery::mock(VehicleService::class);
        $this->app->instance(VehicleService::class, $mockService);

        $vehicle = Vehicle::factory()->create();

        $mockService->shouldReceive('delete')
            ->once()
            ->with($vehicle->id)
            ->andReturnNull();

        $response = $this->deleteJson("/api/v1/vehicles/{$vehicle->id}");

        $response->assertNoContent();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
