<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeStatus;
use App\Http\Requests\EmployeeStatusRequest;
use App\Http\Helpers\ApiResponse;

class EmployeeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employeeStatuses = EmployeeStatus::all();
        return ApiResponse::success($employeeStatuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EmployeeStatusRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeStatusRequest $request)
    {
        $employeeStatus = EmployeeStatus::create($request->validated());
        return ApiResponse::created($employeeStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $employeeStatus = EmployeeStatus::find($id);
        if (!$employeeStatus) {
            return ApiResponse::notFound('EmployeeStatus not found');
        }
        return ApiResponse::success($employeeStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployeeStatusRequest $request, $id)
    {
        $employeeStatus = EmployeeStatus::find($id);
        if (!$employeeStatus) {
            return ApiResponse::notFound('EmployeeStatus not found');
        }
        $employeeStatus->update($request->all());
        return ApiResponse::updated($employeeStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $employeeStatus = EmployeeStatus::find($id);
        if (!$employeeStatus) {
            return ApiResponse::notFound('EmployeeStatus not found');
        }
        $employeeStatus->delete();
        return ApiResponse::deleted('EmployeeStatus deleted successfully');
    }
}
