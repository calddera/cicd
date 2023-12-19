<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContractType;
use App\Http\Requests\ContractTypeRequest;
use App\Http\Helpers\ApiResponse;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contractTypes = ContractType::all();
        return ApiResponse::success($contractTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContractTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContractTypeRequest $request)
    {
        $contractType = ContractType::create($request->validated());
        return ApiResponse::created($contractType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $contractType = ContractType::find($id);
        if (!$contractType) {
            return ApiResponse::notFound('ContractType not found');
        }
        return ApiResponse::success($contractType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $contractType = ContractType::find($id);
        if (!$contractType) {
            return ApiResponse::notFound('ContractType not found');
        }
        $contractType->update($request->all());
        return ApiResponse::updated($contractType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $contractType = ContractType::find($id);
        if (!$contractType) {
            return ApiResponse::notFound('ContractType not found');
        }
        $contractType->delete();
        return ApiResponse::deleted('ContractType deleted successfully');
    }
}
