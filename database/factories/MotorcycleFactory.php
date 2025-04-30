<?php

namespace Database\Factories;

use App\Enums\MotorcycleStyle;
use App\Enums\VehicleType;
use App\Models\Motorcycle;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class MotorcycleFactory extends Factory
{
    protected $model = Motorcycle::class;

    #[ArrayShape(
        [
            'vehicle_id' => "integer",
            'style' => "string",
            'has_sidecar' => "bool"
        ]
    )]
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory()->state([
                'type' => VehicleType::MOTORCYCLE,
            ]),
            'style' => $this->faker->randomElement(MotorcycleStyle::values()),
            'has_sidecar' => $this->faker->boolean(20),
        ];
    }
}
