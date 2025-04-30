<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'type'          => $this->type,
            'brand'         => $this->brand,
            'model'         => $this->model,
            'year'          => $this->year,
            'engine_cc'     => $this->engine_cc,
            'fuel_type'     => $this->fuel_type,
            'is_hybrid'     => $this->is_hybrid,
            'is_electric'   => $this->is_electric,
            'price'         => $this->price,
            'currency'      => $this->currency,
            'color'         => $this->color,
            'mileage'       => $this->mileage,
            'mileage_unit'  => $this->mileage_unit,
            'consumption'   => $this->consumption,
            'consumption_unit' => $this->consumption_unit,
            'images'        => $this->images,
            'discount'      => $this->discount,
            'stock'         => $this->stock,
            'car_details'   => $this->when($this->type === 'CAR', [
                'doors'             => $this->car->doors,
                'trunk_capacity'    => $this->car->trunk_capacity,
                'measurement_type'  => $this->car->measurement_type,
                'isofix_nr'         => $this->car->isofix_nr,
            ]),
            'motorcycle_details' => $this->when($this->type === 'MOTORCYCLE', [
                'style'         => $this->motorcycle->style,
                'has_sidecar'   => $this->motorcycle->has_sidecar,
            ]),
            'truck_details' => $this->when($this->type === 'TRUCK', [
                'capacity_tons' => $this->truck->capacity_tons,
                'axles'         => $this->truck->axles,
                'is_four_wheel' => $this->truck->is_four_wheel,
                'beds_nr'       => $this->truck->beds_nr,
            ]),
        ];
    }
}
