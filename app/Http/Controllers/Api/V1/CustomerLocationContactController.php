<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\CustomerLocation;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Models\CustomerLocationContact;
use App\Http\Requests\CustomerLocationContactRequest;

class CustomerLocationContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CustomerLocationContact::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['contact_name', 'contact_email', 'contact_phone_number']);

        $customerLocationContacts = $query->get();

        return ApiResponse::success($customerLocationContacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CustomerLocationContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerLocationContactRequest $request)
    {
        $customerLocationContact = CustomerLocationContact::create($request->validated());
        return ApiResponse::created($customerLocationContact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerLocationContact = CustomerLocationContact::find($id);

        if (!$customerLocationContact) {
            return ApiResponse::notFound('Customer Location not found.');
        }

        return ApiResponse::success($customerLocationContact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CustomerLocationContactRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerLocationContactRequest $request, $id)
    {
        $customerLocationContact = CustomerLocationContact::find($id);

        if (!$customerLocationContact) {
            return ApiResponse::notFound('Customer Location not found.');
        }

        $customerLocationContact->update($request->validated());
        return ApiResponse::updated($customerLocationContact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerLocationContact = CustomerLocationContact::find($id);

        if (!$customerLocationContact) {
            return ApiResponse::notFound('Customer Location not found.');
        }

        $customerLocationContact->delete();
        return ApiResponse::deleted('CustomerLocationContact deleted successfully.');
    }
}
