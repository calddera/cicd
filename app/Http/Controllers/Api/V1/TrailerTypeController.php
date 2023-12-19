<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TrailerType;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrailerTypeRequest;

class TrailerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TrailerType::query();

        $query = QueryFilter::Filter($request, $query);

        $trailerTypes = $query->get();

        return ApiResponse::success($trailerTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TrailerTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrailerTypeRequest $request)
    {
        $trailerType = TrailerType::create($request->validated());

        return ApiResponse::created($trailerType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trailerType = TrailerType::find($id);

        if (!$trailerType) {
            return ApiResponse::notFound('DocumentType not found');
        }

        return ApiResponse::success($trailerType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TrailerTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TrailerTypeRequest $request, $id)
    {
        $trailerType = TrailerType::find($id);

        if (!$trailerType) {
            return ApiResponse::notFound('TrailerType not found');
        }

        $trailerType->update($request->validated());

        return ApiResponse::updated($trailerType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $trailerType = TrailerType::find($id);

        if (!$trailerType) {
            return ApiResponse::notFound('TrailerType not found');
        }

        $trailerType->delete();

        return ApiResponse::deleted('TrailerType deleted successfully');
    }
}
