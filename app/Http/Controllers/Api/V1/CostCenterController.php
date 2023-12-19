<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\CostCenter;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CostCenterRequest;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = CostCenter::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['code_center_code']);

        $costCenters = $query->get();
        return ApiResponse::success($costCenters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CostCenterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CostCenterRequest $request)
    {
        $costCenter = CostCenter::create($request->validated());
        return ApiResponse::created($costCenter);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $costCenter = CostCenter::find($id);

        if (!$costCenter) {
            return ApiResponse::notFound('CostCenter not found.');
        }

        return ApiResponse::success($costCenter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CostCenterRequest $request, $id)
    {
        $costCenter = CostCenter::find($id);

        if (!$costCenter) {
            return ApiResponse::notFound('CostCenter not found.');
        }

        $costCenter->update($request->validated());
        return ApiResponse::updated($costCenter);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $costCenter = CostCenter::find($id);

        if (!$costCenter) {
            return ApiResponse::notFound('CostCenter not found');
        }

        $costCenter->delete();
        return ApiResponse::deleted('CostCenter deleted successfully');
    }
}
