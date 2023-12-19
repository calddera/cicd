<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Geofence;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeofenceRequest;

class GeofenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Geofence::query();

        $query = QueryFilter::Filter($request, $query);

        $geofences = $query->get();

        return ApiResponse::success($geofences);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\GeofenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeofenceRequest $request)
    {
        $geofence = Geofence::create($request->validated());
        return ApiResponse::created($geofence);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $geofence = Geofence::find($id);
        if (!$geofence) {
            return ApiResponse::notFound('Geofence not found');
        }
        return ApiResponse::success($geofence);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GeofenceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GeofenceRequest $request, $id)
    {
        $geofence = Geofence::find($id);

        if (!$geofence) {
            return ApiResponse::notFound('Geofence not found.');
        }

        $geofence->update($request->validated());
        return ApiResponse::updated($geofence);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $geofence = Geofence::find($id);

        if (!$geofence) {
            return ApiResponse::notFound('Geofence not found.');
        }

        $geofence->is_deleted = true;
        $geofence->save();

        $geofence->delete();
        return ApiResponse::deleted('Geofence deleted successfully.');
    }
}
