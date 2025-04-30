<?php

namespace Database\Factories;

use App\Enums\VehicleType;
use App\Models\Truck;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class TruckFactory extends Factory
{
    protected $model = Truck::class;

    #[ArrayShape(
        [
            'vehicle_id' => "int",
            'capacity_tons' => "float",
            'axles' => "int",
            'is_four_wheel' => "bool",
            'beds_nr' => "int"
        ]
    )]
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory()->state([
                'type' => VehicleType::TRUCK,
            ]),
            'capacity_tons' => $this->faker->randomFloat(1, 1, 40),
            'axles' => $this->faker->numberBetween(2, 8),
            'is_four_wheel' => $this->faker->boolean(),
            'beds_nr' => $this->faker->numberBetween(1, 3),
        ];
    }
}
