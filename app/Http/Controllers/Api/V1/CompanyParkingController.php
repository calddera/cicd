<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyParking;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyParkingRequest;

class CompanyParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = CompanyParking::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['parking_name', 'parking_address']);

        $companyParkings = $query->get();
        return ApiResponse::success($companyParkings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CompanyParkingRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyParkingRequest $request)
    {
        $company = Company::find($request->company_id);

        if (!$company) {
            return ApiResponse::error('Invalid company');
        }

        $companyParking = CompanyParking::create($request->validated());
        return ApiResponse::created($companyParking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $companyParking = CompanyParking::find($id);

        if (!$companyParking) {
            return ApiResponse::notFound('CompanyParking not found.');
        }

        return ApiResponse::success($companyParking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompanyParkingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyParkingRequest $request, $id)
    {
        $companyParking = CompanyParking::find($id);

        if (!$companyParking) {
            return ApiResponse::notFound('CompanyParking not found.');
        }

        $companyParking->update($request->validated());
        return ApiResponse::updated($companyParking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $companyParking = CompanyParking::find($id);

        if (!$companyParking) {
            return ApiResponse::notFound('CompanyParking not found.');
        }

        $companyParking->delete();
        return ApiResponse::deleted('CompanyParking deleted successfully.');
    }
}
