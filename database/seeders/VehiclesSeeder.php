<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Truck;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::factory(50)->create();
        Truck::factory(5)->create();
        Motorcycle::factory(15)->create();
    }
}
