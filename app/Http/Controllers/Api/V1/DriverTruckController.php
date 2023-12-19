<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Truck;
use App\Models\Employee;
use App\Models\DriverTruck;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverTruckRequest;

class DriverTruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $driverTrucks = DriverTruck::all();

        return ApiResponse::success($driverTrucks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DriverTruckRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DriverTruckRequest $request)
    {
        $truck = Truck::find($request->truck_id);

        if (!$truck) {
            return ApiResponse::error('Invalid truck.');
        }

        $employee = Employee::find($request->employee_id);

        if (!$employee) {
            return ApiResponse::error('Invalid employee.');
        }

        $data = $request->validated();

        // TODO: assign auth user to assignedby

        $data['assigned_at'] = Carbon::now();
        $data['assigned_by'] = User::first()->user_id;

        $driverTruck = DriverTruck::create($data);

        return ApiResponse::created($driverTruck);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $driverTruck = DriverTruck::find($id);

        if (!$driverTruck) {
            return ApiResponse::notFound('Trailer not found.');
        }

        return ApiResponse::success($driverTruck);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DriverTruckRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DriverTruckRequest $request, $id)
    {
        $driverTruck = DriverTruck::find($id);

        if (!$driverTruck) {
            return ApiResponse::notFound('DriverTruck not found.');
        }

        $driverTruck->update($request->validated());

        return ApiResponse::updated($driverTruck);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $driverTruck = DriverTruck::find($id);

        if (!$driverTruck) {
            return ApiResponse::notFound('DriverTruck not found.');
        }

        $driverTruck->delete();

        return ApiResponse::deleted('DriverTruck deleted successfully.');
    }
}
