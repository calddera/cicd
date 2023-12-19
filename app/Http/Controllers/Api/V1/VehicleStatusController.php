<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\VehicleStatus;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\VehicleStatusRequest;

class VehicleStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {        
        $query = VehicleStatus::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['status_name']);
        
        $vehicleStatuses = $query->get();

        return ApiResponse::success($vehicleStatuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VehicleStatusRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VehicleStatusRequest $request)
    {
        $vehicleStatus = VehicleStatus::create($request->validated());

        return ApiResponse::created($vehicleStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $vehicleStatus = VehicleStatus::find($id);

        if (!$vehicleStatus) {
            return ApiResponse::notFound('VehicleStatus not found');
        }

        return ApiResponse::success($vehicleStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VehicleStatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VehicleStatusRequest $request, $id)
    {
        $vehicleStatus = VehicleStatus::find($id);

        if (!$vehicleStatus) {
            return ApiResponse::notFound('VehicleStatus not found');
        }

        $vehicleStatus->update($request->validated());

        return ApiResponse::updated($vehicleStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $vehicleStatus = VehicleStatus::find($id);

        if (!$vehicleStatus) {
            return ApiResponse::notFound('VehicleStatus not found.');
        }

        $vehicleStatus->delete();

        return ApiResponse::deleted('VehicleStatus deleted successfully.');
    }
}
