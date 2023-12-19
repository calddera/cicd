<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Truck;
use App\Models\TruckTag;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TruckTagRequest;

class TruckTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TruckTag::query();

        $query = QueryFilter::Filter($request, $query);

        $truckTags = $query->get();

        return ApiResponse::success($truckTags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TruckTagRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TruckTagRequest $request)
    {
        $truck = Truck::find($request->truck_id);

        if (!$truck) {
            return ApiResponse::error('Invalid Truck.');
        }

        $truckTag = TruckTag::create($request->validated());

        return ApiResponse::created($truckTag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $truckTag = TruckTag::find($id);

        if (!$truckTag) {
            return ApiResponse::notFound('TruckTag not found.');
        }

        return ApiResponse::success($truckTag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TruckTagRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TruckTagRequest $request, $id)
    {
        $truckTag = TruckTag::find($id);

        if (!$truckTag) {
            return ApiResponse::notFound('TruckTag not found.');
        }

        $truckTag->update($request->validated());

        return ApiResponse::updated($truckTag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $truckTag = TruckTag::find($id);

        if (!$truckTag) {
            return ApiResponse::notFound('TruckTag not found.');
        }

        $truckTag->delete();

        return ApiResponse::deleted('TruckTag deleted successfully.');

    }
}
