<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Truck;
use App\Models\TruckTire;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TruckTireRequest;

class TruckTireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TruckTire::query();

        $query = QueryFilter::Filter($request, $query);

        $truckTires = $query->get();

        return ApiResponse::success($truckTires);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TruckTireRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TruckTireRequest $request)
    {
        $truck = Truck::find($request->truck_id);

        if (!$truck) {
            return ApiResponse::error('Invalid Truck');
        }

        $truckTire = TruckTire::create($request->validated());

        return ApiResponse::created($truckTire);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $truckTire = TruckTire::find($id);

        if (!$truckTire) {
            return ApiResponse::notFound('TruckTire not found.');
        }

        return ApiResponse::success($truckTire);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TruckTireRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TruckTireRequest $request, $id)
    {
        $truckTire = TruckTire::find($id);

        if (!$truckTire) {
            return ApiResponse::notFound('TruckTire not found.');
        }

        $truckTire->update($request->validated());

        return ApiResponse::updated($truckTire);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $truckTire = TruckTire::find($id);

        if (!$truckTire) {
            return ApiResponse::notFound('TruckTire not found.');
        }
        
        $truckTire->delete();

        return ApiResponse::deleted('TruckTire deleted successfully.');

    }
}
