<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\VehicleStatus;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\TruckRequest;
use App\Http\Controllers\Controller;
use App\Http\Helpers\QueryFilter;
use App\Http\Resources\TruckResource;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Truck::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['vin_number', 'unit_number']);

        $query = $query->with(['vehicleStatus', 'currentPlate']);
        
        $trucks = $query->get();

        return ApiResponse::success($trucks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TruckRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TruckRequest $request)
    {
        $vehicleStatus = VehicleStatus::find($request->vehicle_status_id);

        if (!$vehicleStatus) {
            return ApiResponse::error('Invalid Vehicle Status');
        }

        $data = $request->validated();

        //TODO: Assign createdby and updatedby to auth user and validate
        //Por ahora hay que correr db:seed antes

        // $data['created_by'] = User::first()->user_id;
        // $data['updated_by'] = User::first()->user_id;

        $truck = Truck::create($data);

        return ApiResponse::created(new TruckResource($truck));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $truck = Truck::find($id);

        if (!$truck) {
            return ApiResponse::notFound('Truck not found.');
        }

        return ApiResponse::success(new TruckResource($truck));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TruckRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TruckRequest $request, $id)
    {
        $truck = Truck::find($id);

        if (!$truck) {
            return ApiResponse::notFound('Truck not found.');
        }

        // TODO: Assign updatedby to auth user

        $truck->update($request->validated());

        return ApiResponse::updated($truck);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $truck = Truck::find($id);

        if (!$truck) {
            return ApiResponse::notFound('Truck not found.');
        }

        $truck->delete();

        return ApiResponse::deleted('Truck deleted successfully.');
    }
}
