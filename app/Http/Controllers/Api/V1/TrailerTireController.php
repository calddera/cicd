<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Trailer;
use App\Models\TrailerTire;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrailerTireRequest;

class TrailerTireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TrailerTire::query();

        $query = QueryFilter::Filter($request, $query);
        
        $trailerTires = $query->get();

        return ApiResponse::success($trailerTires);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TrailerTireRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrailerTireRequest $request)
    {
        $trailer = Trailer::find($request->trailer_id);

        if (!$trailer) {
            return ApiResponse::error('Invalid trailer.');
        }

        $trailerTire = TrailerTire::create($request->validated());

        return ApiResponse::created($trailerTire);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trailerTire = TrailerTire::find($id);

        if (!$trailerTire) {
            return ApiResponse::notFound('TrailerTire not found.');
        }

        return ApiResponse::success($trailerTire);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TrailerTireRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TrailerTireRequest $request, $id)
    {
        $trailerTire = TrailerTire::find($id);

        if (!$trailerTire) {
            return ApiResponse::notFound('TrailerTire not found.');
        }

        $trailerTire->update($request->validated());

        return ApiResponse::updated($trailerTire);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $trailerTire = TrailerTire::find($id);

        if (!$trailerTire) {
            return ApiResponse::notFound('TrailerTire not found.');
        }

        $trailerTire->delete();

        return ApiResponse::deleted('TrailerTire deleted successfully.');
    }
}
