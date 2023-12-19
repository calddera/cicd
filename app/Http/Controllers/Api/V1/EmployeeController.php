<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employees = Employee::with(
            [
                'job',
                'job.department',
                'job.department.company',
                'status',
                'documents'
            ]
        )->get();

        $employees = [
            "hola" => "mundo",
            "Cara" => "Colas"
        ];

        return ApiResponse::success($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeRequest $request)
    {
        $filePath = "";
        if ($request->image_file) {
            $filePath = Helper::uploadBase64File('profile', $request->image_file);
        }

        $data = $request->validated();
        $data["image"] = $filePath;

        $employee = Employee::create($data);
        return ApiResponse::created($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return ApiResponse::notFound('Employee not found');
        }
        return ApiResponse::success($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return ApiResponse::notFound('Employee not found');
        }

        $filePath = $employee->image;
        if ($request->image_file) {
            $filePath = Helper::uploadBase64File('profile', $request->image_file);
        }

        $data = $request->validated();
        $data["image"] = $filePath; //If no file sent, will keep current value

        $employee->update($data);
        return ApiResponse::updated($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return ApiResponse::notFound('Employee not found');
        }
        $employee->delete();
        return ApiResponse::deleted('Employee deleted successfully');
    }
}
