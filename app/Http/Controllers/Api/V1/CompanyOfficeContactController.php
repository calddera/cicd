<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\CompanyOffice;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Models\CompanyOfficeContact;
use App\Http\Requests\CompanyOfficeContactRequest;

class CompanyOfficeContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = CompanyOfficeContact::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['contact_name', 'contact_address', 'contact_phone_number']);

        $companyOfficeContacts = $query->get();
        return ApiResponse::success($companyOfficeContacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CompanyOfficeContactRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyOfficeContactRequest $request)
    {
        $companyOffice = CompanyOffice::find($request->company_office_id);

        if (!$companyOffice) {
            return ApiResponse::error('Invalid company office');
        }

        $companyOfficeContact = CompanyOfficeContact::create($request->validated());

        return ApiResponse::created($companyOfficeContact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $companyOfficeContact = CompanyOfficeContact::find($id);

        if (!$companyOfficeContact) {
            return ApiResponse::notFound('CompanyOfficeContact not found.');
        }

        return ApiResponse::success($companyOfficeContact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CompanyOfficeContactRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompanyOfficeContactRequest $request, $id)
    {
        $companyOfficeContact = CompanyOfficeContact::find($id);

        if (!$companyOfficeContact) {
            return ApiResponse::notFound('CompanyOfficeContact not found.');
        }

        $companyOfficeContact->update($request->validated());
        return ApiResponse::updated($companyOfficeContact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $companyOfficeContact = CompanyOfficeContact::find($id);

        if (!$companyOfficeContact) {
            return ApiResponse::notFound('CompanyOfficeContact not found.');
        }

        $companyOfficeContact->delete();
        return ApiResponse::deleted('CompanyOfficeContact deleted successfully.');
    }
}
