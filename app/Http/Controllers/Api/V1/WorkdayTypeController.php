<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkdayType;
use App\Http\Requests\WorkdayTypeRequest;
use App\Http\Helpers\ApiResponse;

class WorkdayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $workdayTypes = WorkdayType::all();
        return ApiResponse::success($workdayTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WorkdayTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WorkdayTypeRequest $request)
    {
        $workdayType = WorkdayType::create($request->validated());
        return ApiResponse::created($workdayType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $workdayType = WorkdayType::find($id);
        if (!$workdayType) {
            return ApiResponse::notFound('WorkdayType not found');
        }
        return ApiResponse::success($workdayType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\WorkdayTypeRequest   $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WorkdayTypeRequest $request, $id)
    {
        $workdayType = WorkdayType::find($id);
        if (!$workdayType) {
            return ApiResponse::notFound('WorkdayType not found');
        }
        $workdayType->update($request->all());
        return ApiResponse::updated($workdayType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $workdayType = WorkdayType::find($id);
        if (!$workdayType) {
            return ApiResponse::notFound('WorkdayType not found');
        }
        $workdayType->delete();
        return ApiResponse::deleted('WorkdayType deleted successfully');
    }
}
