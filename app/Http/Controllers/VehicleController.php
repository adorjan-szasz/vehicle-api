<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{
    public function __construct(private VehicleService $vehicleService) {}

    public function store(VehicleRequest $request)
    {
        $vehicle = $this->vehicleService->create($request);

        return response()->json(new VehicleResource($vehicle), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/vehicles",
     *     summary="Get a list of vehicles",
     *     tags={"Vehicles"},
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         description="Number of vehicles to retrieve",
     *         required=false,
     *         @OA\Schema(type="integer", default=50)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of vehicles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Vehicle")
     *         )
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $paginator = $this->vehicleService->getVehiclesFiltered($request);

        return VehicleResource::collection($paginator);
    }

    public function show($id)
    {
        $vehicle = $this->vehicleService->getById($id);
        return response()->json(new VehicleResource($vehicle));
    }

    public function update(VehicleRequest $request, $id)
    {
        $vehicle = $this->vehicleService->update($request, $id);

        return response()->json(new VehicleResource($vehicle));
    }

    public function destroy($id)
    {
        $this->vehicleService->delete($id);

        return response()->json(null, 204);
    }
}
