<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\LocationType;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationTypeRequest;

class LocationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = LocationType::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['location_type_name']);

        $locationTypes = $query->get();

        return ApiResponse::success($locationTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locationType = LocationType::create($request->validated());
        return ApiResponse::created($locationType);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LocationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationTypeRequest $request)
    {
        $locationType = LocationType::create($request->validated());
        return ApiResponse::created($locationType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locationType = LocationType::find($id);
        if (!$locationType) {
            return ApiResponse::notFound('LocationType not found.');
        }
        return ApiResponse::success($locationType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\LocationTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationTypeRequest $request, $id)
    {
        $locationType = LocationType::find($id);

        if (!$locationType) {
            return ApiResponse::notFound('LocationType not found.');
        }

        $locationType->update($request->validated());
        return ApiResponse::updated($locationType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locationType = LocationType::find($id);

        if (!$locationType) {
            return ApiResponse::notFound('LocationType not found.');
        }

        $locationType->delete();
        return ApiResponse::deleted('LocationType deleted successfully.');
    }
}
