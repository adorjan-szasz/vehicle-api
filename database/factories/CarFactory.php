<?php

namespace Database\Factories;

use App\Enums\MeasurementType;
use App\Enums\VehicleType;
use App\Models\Car;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class CarFactory extends Factory
{
    protected $model = Car::class;

    #[ArrayShape(
        [
            'vehicle_id' => "int",
            'doors' => "int",
            'trunk_capacity' => "int",
            'measurement_type' => "string",
            'isofix_nr' => "int"
        ]
    )]
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory()->state([
                'type' => VehicleType::CAR,
            ]),
            'doors' => $this->faker->randomElement([2, 4, 5]),
            'trunk_capacity' => $this->faker->numberBetween(1, 999),
            'measurement_type' => $this->faker->randomElement(MeasurementType::values()),
            'isofix_nr' => $this->faker->numberBetween(0, 3),
        ];
    }
}
