<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Models\LocationType;
use Illuminate\Http\Request;
use App\Models\CustomerLocation;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLocationRequest;

class CustomerLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CustomerLocation::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['customer_location_name', 'location_zipcode', 'location_address']);

        $query = $query->with('locationType');

        $customerLocations = $query->get();

        return ApiResponse::success($customerLocations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CustomerLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerLocationRequest $request)
    {
        $customerLocation = CustomerLocation::create($request->validated());
        return ApiResponse::created($customerLocation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerLocation = CustomerLocation::find($id);
        if (!$customerLocation) {
            return ApiResponse::notFound('Customer Location not found.');
        }
        return ApiResponse::success($customerLocation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CustomerLocationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerLocationRequest $request, $id)
    {
        $customerLocation = CustomerLocation::find($id);

        if (!$customerLocation) {
            return ApiResponse::notFound('Customer Location not found.');
        }

        $customerLocation->update($request->validated());
        return ApiResponse::updated($customerLocation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerLocation = CustomerLocation::find($id);

        if (!$customerLocation) {
            return ApiResponse::notFound('Customer Location not found.');
        }

        $customerLocation->delete();
        return ApiResponse::deleted('CustomerLocation deleted successfully.');
    }
}
