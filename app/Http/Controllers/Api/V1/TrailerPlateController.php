<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Trailer;
use App\Models\TrailerPlate;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrailerPlateRequest;

class TrailerPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TrailerPlate::query();

        $query = QueryFilter::Filter($request, $query);
        
        $trailerPlates = $query->get();

        return ApiResponse::success($trailerPlates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TrailerPlateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrailerPlateRequest $request)
    {
        $trailer = Trailer::find($request->trailer_id);

        if (!$trailer) {
            return ApiResponse::error('Invalid trailer.');
        }

        $trailerPlate = TrailerPlate::create($request->validated());

        return ApiResponse::created($trailerPlate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trailerPlate = TrailerPlate::find($id);

        if (!$trailerPlate) {
            return ApiResponse::notFound('TrailerPlate not found.');
        }

        return ApiResponse::success($trailerPlate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TrailerPlateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TrailerPlateRequest $request, $id)
    {
        $trailerPlate = TrailerPlate::find($id);

        if (!$trailerPlate) {
            return ApiResponse::notFound('TrailerPlate not found.');
        }

        $trailerPlate->update($request->validated());

        return ApiResponse::updated($trailerPlate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $trailerPlate = TrailerPlate::find($id);

        if (!$trailerPlate) {
            return ApiResponse::notFound('TrailerPlate not found.');
        }

        $trailerPlate->delete();

        return ApiResponse::deleted('TrailerPlate deleted successfully.');
    }
}
