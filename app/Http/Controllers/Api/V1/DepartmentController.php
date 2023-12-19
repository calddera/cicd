<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Department::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['department_name']);

        $departments = $query->get();
        return ApiResponse::success($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DepartmentRequest $request)
    {
        $company = Company::find($request->company_id);

        if (!$company) {
            return ApiResponse::error('Invalid company.');
        }

        $department = Department::create($request->validated());
        return ApiResponse::created($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiResponse::notFound('Department not found');
        }
        return ApiResponse::success($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiResponse::notFound('Department not found');
        }
        $department->update($request->validated());
        return ApiResponse::updated($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return ApiResponse::notFound('Department not found');
        }
        $department->delete();
        return ApiResponse::deleted('Department deleted successfully');
    }
}
