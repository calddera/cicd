<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Truck;
use App\Models\TruckPlate;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Helpers\QueryFilter;
use App\Http\Requests\TruckPlateRequest;

class TruckPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TruckPlate::query();

        $query = QueryFilter::Filter($request, $query);

        $truckPlates = $query->get();

        return ApiResponse::success($truckPlates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TruckPlateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TruckPlateRequest $request)
    {
        $truck = Truck::find($request->truck_id);

        if (!$truck) {
            return ApiResponse::error('Invalid Truck.');
        }

        $truckPlate = TruckPlate::create($request->validated());

        return ApiResponse::created($truckPlate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $truckPlate = TruckPlate::find($id);

        if (!$truckPlate) {
            return ApiResponse::notFound('TruckPlate not found.');
        }

        return ApiResponse::success($truckPlate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TruckPlateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TruckPlateRequest $request, $id)
    {
        $truckPlate = TruckPlate::find($id);

        if (!$truckPlate) {
            return ApiResponse::notFound('TruckPlate not found.');
        }

        $truckPlate->update($request->validated());

        return ApiResponse::updated($truckPlate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $truckPlate = TruckPlate::find($id);

        if (!$truckPlate) {
            return ApiResponse::notFound('TruckPlate not found.');
        }

        $truckPlate->delete();

        return ApiResponse::deleted('TruckPlate deleted successfully.');

    }
}
