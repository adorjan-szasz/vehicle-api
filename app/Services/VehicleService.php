<?php

namespace App\Services;

use App\Enums\VehicleType;
use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class VehicleService
{
    protected Vehicle $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function getAll(): Collection
    {
        return $this->vehicle->all();
    }

    public function getById(int $id): ?Vehicle
    {
        return $this->vehicle->with(['car', 'motorcycle', 'truck'])->findOrFail($id);
    }

    public function getVehiclesFiltered(Request $request): LengthAwarePaginator
    {
        $quantity = $request->query('quantity', 50);

        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:500',
        ]);

        // Generate a collection of random vehicles if database is not set up and seeders are not executed
//        $vehicles = collect(range(1, $quantity))->map(fn() => Vehicle::generateRandomVehicle());

        $query = $this->vehicle->query();

        // Filtering by type (Car, Motorcycle, Truck)
        if ($request->has('type')) {
            $query->where('type', $request->query('type'));
        }

        // Filtering by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [
                $request->query('min_price'),
                $request->query('max_price')
            ]);
        }

        // Sorting functionality by price or name
        if ($request->has('sort_by')) {
            $sortBy = $request->query('sort_by');
            $sortOrder = $request->query('sort_order', 'asc');
            if (in_array($sortBy, ['price', 'model']) && in_array($sortOrder, ['asc', 'desc'])) {
                $query->orderBy($sortBy, $sortOrder);
            }
        }

        $vehicles = $query->take($quantity)->get();

        $perPage = 15;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedData = $vehicles->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $pagedData,
            $quantity,
            $perPage,
            $currentPage,
            [
                'path' => url('/api/v1/vehicles'),
                'query' => ['quantity' => $quantity],
            ]
        );
    }

    public function create(VehicleRequest $request): Vehicle
    {
        $vehicleData = $request->validated();

        $vehicle = $this->vehicle->create($vehicleData);

        match (VehicleType::from($vehicleData['type'])) {
            VehicleType::CAR => $vehicle->car()->create($request->only(
                [
                    'vehicle_id',
                    'doors',
                    'trunk_capacity',
                    'measurement_type',
                    'isofix_nr'
                ]
            )),
            VehicleType::MOTORCYCLE => $vehicle->motorcycle()->create($request->only(
                [
                    'vehicle_id',
                    'style',
                    'has_sidecar'
                ]
            )),
            VehicleType::TRUCK => $vehicle->truck()->create($request->only(
                [
                    'vehicle_id',
                    'capacity_tons',
                    'axles',
                    'is_four_wheel',
                    'beds_nr'
                ]
            )),
        };

        return $vehicle;
    }

    public function update(VehicleRequest $request, $id): ?Vehicle
    {
        $vehicle = $this->vehicle->findOrFail($id);
        $vehicle->update($request->validated());

        return $vehicle;
    }

    public function delete(int $id): void
    {
        $vehicle = $this->vehicle->findOrFail($id);

        $vehicle->delete();
    }
}
