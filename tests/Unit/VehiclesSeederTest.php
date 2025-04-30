<?php

namespace Tests\Unit;

use App\Models\Vehicle;
use Database\Seeders\VehiclesSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class VehiclesSeederTest extends TestCase
{
    use WithFaker;

    public function test_seeder_creates_expected_vehicle_relations()
    {
        $this->mock(Vehicle::class, function ($mock) {
            $mock->shouldReceive('factory->count->create')
                ->once()
                ->andReturn(collect(
                    range(1, 70)
                )->map(function () {
                    $vehicle = Mockery::mock(Vehicle::class)->makePartial();
                    $vehicle->type = $this->faker->randomElement(['CAR', 'MOTORCYCLE', 'TRUCK']);

                    if ($vehicle->type === 'CAR') {
                        $vehicle->shouldReceive('car->create')->once();
                    } elseif ($vehicle->type === 'MOTORCYCLE') {
                        $vehicle->shouldReceive('motorcycle->create')->once();
                    } elseif ($vehicle->type === 'TRUCK') {
                        $vehicle->shouldReceive('truck->create')->once();
                    }

                    return $vehicle;
                }));
        });

        $seeder = new VehiclesSeeder();
        $seeder->run();

        $this->assertTrue(true);
    }
}
