<?php

namespace Database\Factories;

use App\Enums\ConsumptionUnit;
use App\Enums\Currency;
use App\Enums\FuelType;
use App\Enums\MileageUnit;
use App\Enums\VehicleType;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(VehicleType::values());

        return [
            'type' => $type,
            'brand' => $this->faker->company(),
            'model' => $this->faker->word(),
            'year' => $this->faker->year(),
            'engine_cc' => $this->faker->randomFloat(2, 49, 30000),
            'fuel_type' => $this->faker->randomElement(FuelType::values()),
            'is_hybrid' => $this->faker->boolean(),
            'is_electric' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(2, 5000, 350000),
            'currency' => $this->faker->randomElement(Currency::values()),
            'color' => $this->faker->safeColorName(),
            'mileage' => $this->faker->optional()->randomFloat(2, 0, 1000000),
            'mileage_unit' => $this->faker->randomElement(MileageUnit::values()),
            'consumption' => $this->faker->randomElement($this->getConsumption($type)),
            'consumption_unit' => $this->faker->randomElement(ConsumptionUnit::values()),
            'images' => [
                $this->faker->imageUrl(300, 300),
                $this->faker->imageUrl(300, 300),
                $this->faker->imageUrl(300, 300),
            ],
            'discount' => $this->faker->optional()->randomFloat(2, 0, 1),
            'stock' => $this->faker->optional()->numberBetween(0, 50),
        ];
    }

    private function getConsumption(string $type): array
    {
        return match ($type) {
            'CAR' => ['6.7L/100km', '8.2L/100km', '10L/100km', '14L/100km'],
            'MOTORCYCLE' => ['4.2L/100km', '4.6L/100km', '5L/100km', '6.5L/100km'],
            'TRUCK' => ['24L/100km', '27.5L/100km', '32L/100km', '34.3L/100km'],
            default => ['N/A'],
        };

    }
}
