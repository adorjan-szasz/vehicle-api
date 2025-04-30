<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Vehicle",
 *     required={"type", "brand", "model", "year", "engine_cc", "fuel_type", "price", "currency"},
 *     @OA\Property(property="id", type="integer", readOnly=true),
 *     @OA\Property(property="type", type="string", example="CAR"),
 *     @OA\Property(property="brand", type="string", example="Toyota"),
 *     @OA\Property(property="model", type="string", example="Corolla"),
 *     @OA\Property(property="year", type="integer", example=2020),
 *     @OA\Property(property="engine_cc", type="number", format="float", example=1800),
 *     @OA\Property(property="fuel_type", type="string", example="Petrol"),
 *     @OA\Property(property="is_hybrid", type="boolean", example=false),
 *     @OA\Property(property="is_electric", type="boolean", example=false),
 *     @OA\Property(property="price", type="number", format="float", example=20000),
 *     @OA\Property(property="currency", type="string", example="USD"),
 *     @OA\Property(property="color", type="string", example="Red"),
 *     @OA\Property(property="mileage", type="number", format="float", example=15000),
 *     @OA\Property(property="mileage_unit", type="string", example="KM"),
 *     @OA\Property(property="consumption", type="string", example="6.5L/100km"),
 *     @OA\Property(property="consumption_unit", type="string", example="LITER"),
 *     @OA\Property(property="images", type="array", @OA\Items(type="string", format="url")),
 *     @OA\Property(property="discount", type="number", format="float", example=5.0),
 *     @OA\Property(property="stock", type="integer", example=10),
 *     @OA\Property(property="deleted_at", type="string", format="date-time"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'brand',
        'model',
        'year',
        'engine_cc',
        'fuel_type',
        'is_hybrid',
        'is_electric',
        'price',
        'currency',
        'color',
        'mileage',
        'mileage_unit',
        'consumption',
        'consumption_unit',
        'images',
        'discount',
        'stock'
    ];

    protected $casts = [
        'images' => 'array',
        'is_hybrid' => 'boolean',
        'is_electric' => 'boolean',
        'discount' => 'float'
    ];

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    public function motorcycle()
    {
        return $this->hasOne(Motorcycle::class);
    }

    public function truck()
    {
        return $this->hasOne(Truck::class);
    }

    public static function generateRandomVehicle(): self
    {
        $types = [Car::class, Motorcycle::class, Truck::class];

        return $types[array_rand($types)]::factory()->make();
    }
}
