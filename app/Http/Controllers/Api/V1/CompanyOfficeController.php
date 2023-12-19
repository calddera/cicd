<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyOffice;
use App\Http\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Helpers\QueryFilter;
use App\Http\Requests\CompanyOfficeRequest;

class CompanyOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = CompanyOffice::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['office_name', 'office_address']);

        $companyOffices = $query->get();
        return ApiResponse::success($companyOffices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CompanyOfficeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyOfficeRequest $request)
    {
        $company = Company::find($request->company_id);

        if (!$company) {
            return ApiResponse::error('Invalid company.');
        }

        $companyOffice = CompanyOffice::create($request->validated());
        return ApiResponse::created($companyOffice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $companyOffice = CompanyOffice::find($id);

        if (!$companyOffice) {
            return ApiResponse::notFound('CompanyOffice not found.');
        }

        return ApiResponse::success($companyOffice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompanyOfficeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyOfficeRequest $request, $id)
    {
        $companyOffice = CompanyOffice::find($id);

        if (!$companyOffice) {
            return ApiResponse::notFound('CompanyOffice not found.');
        }

        $companyOffice->update($request->validated());
        return ApiResponse::updated($companyOffice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $companyOffice = CompanyOffice::find($id);

        if (!$companyOffice) {
            return ApiResponse::notFound('CompanyOffice not found.');
        }

        $companyOffice->delete();
        return ApiResponse::deleted('CompanyOffice deleted successfully.');
    }
}
