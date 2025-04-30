<?php

namespace App\Http\Requests;

use App\Enums\Currency;
use App\Enums\MeasurementType;
use App\Enums\MileageUnit;
use App\Enums\MotorcycleStyle;
use App\Enums\VehicleType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $vehicleTypes = VehicleType::valuesToString();
        $currencies = Currency::valuesToString();
        $mileageUnits = MileageUnit::valuesToString();
        $measurementTypes = MeasurementType::valuesToString();
        $motoStyles = MotorcycleStyle::valuesToString();

        return [
            'type' => "required|in:$vehicleTypes",
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . now()->year,
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:50',
            'currency' => "required|in:$currencies",
            'mileage' => 'nullable|numeric|min:0',
            'mileage_unit' => "required_with:mileage|in:$mileageUnits",
            'consumption' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'url',
            'discount' => 'nullable|numeric|between:0,1',
            'stock' => 'nullable|integer|min:0',

            // Car
            'doors' => 'required|integer|min:1',
            'trunk_capacity' => 'required|numeric|min:10',
            'measurement_type' => "required|in:$measurementTypes",
            'isofix_nr' => 'required|integer|min:0|max:7',

            // Motorcycle
            'style' => "required|in:$motoStyles",
            'has_sidecar' => 'required|boolean',

            // Truck
            'capacity_tons' => 'required|numeric|min:0|max:80',
            'axles' => 'required|integer|min:2|max:8',
            'is_four_wheel' => 'required|boolean',
            'beds_nr' => 'nullable|integer|min:0|max:3',
        ];
    }
}
