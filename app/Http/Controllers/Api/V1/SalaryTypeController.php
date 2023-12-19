<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryType;
use App\Http\Requests\SalaryTypeRequest;
use App\Http\Helpers\ApiResponse;

class SalaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $salaryTypes = SalaryType::all();
        return ApiResponse::success($salaryTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SalaryTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SalaryTypeRequest $request)
    {
        $salaryType = SalaryType::create($request->validated());
        return ApiResponse::created($salaryType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $salaryType = SalaryType::find($id);
        if (!$salaryType) {
            return ApiResponse::notFound('SalaryType not found');
        }
        return ApiResponse::success($salaryType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SalaryTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SalaryTypeRequest $request, $id)
    {
        $salaryType = SalaryType::find($id);
        if (!$salaryType) {
            return ApiResponse::notFound('SalaryType not found');
        }
        $salaryType->update($request->all());
        return ApiResponse::updated($salaryType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $salaryType = SalaryType::find($id);
        if (!$salaryType) {
            return ApiResponse::notFound('SalaryType not found');
        }
        $salaryType->delete();
        return ApiResponse::deleted('SalaryType deleted successfully');
    }
}
