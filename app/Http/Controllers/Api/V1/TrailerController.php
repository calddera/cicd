<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Trailer;
use Illuminate\Http\Request;
use App\Models\VehicleStatus;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrailerRequest;
use App\Http\Resources\TrailerResource;

class TrailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Trailer::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['vin_number', 'unit_number']);

        $query = $query->with(['trailerModel', 'vehicleStatus', 'trailerType', 'currentPlate']);
        
        $trailers = $query->get();

        return ApiResponse::success($trailers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TrailerRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrailerRequest $request)
    {
        $vehicleStatus = VehicleStatus::find($request->vehicle_status_id);

        if (!$vehicleStatus) {
            return ApiResponse::error('Invalid Vehicle Status');
        }

        $trailerType = VehicleStatus::find($request->trailer_type_id);

        if (!$trailerType) {
            return ApiResponse::error('Invalid Trailer Type');
        }

        $trailerModel = VehicleStatus::find($request->trailer_model_id);

        if (!$trailerModel) {
            return ApiResponse::error('Invalid Trailer Model');
        }

        $data = $request->validated();

        //TODO: Assign createdby and updatedby to auth user and validate
        //Por ahora hay que correr db:seed antes

        // $data['created_by'] = User::first()->user_id;
        // $data['updated_by'] = User::first()->user_id;


        $trailer = Trailer::create($data);

        return ApiResponse::created(new TrailerResource($trailer));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trailer = Trailer::find($id);

        if (!$trailer) {
            return ApiResponse::notFound('Trailer not found.');
        }

        return ApiResponse::success(new TrailerResource($trailer));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TrailerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TrailerRequest $request, $id)
    {
        $trailer = Trailer::find($id);

        if (!$trailer) {
            return ApiResponse::notFound('Trailer not found.');
        }

        // TODO: Assign updatedby to auth user

        $trailer->update($request->validated());

        return ApiResponse::updated($trailer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $trailer = Trailer::find($id);

        if (!$trailer) {
            return ApiResponse::notFound('Trailer not found.');
        }
        
        $trailer->delete();

        return ApiResponse::deleted('Trailer deleted successfully.');
    }
}
