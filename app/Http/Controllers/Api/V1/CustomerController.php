<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerStatus;
use App\Models\CustomerLocation;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\CustomerLocationContact;
use Illuminate\Database\Eloquent\Builder;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['customer_name', 'customer_tax_residence', 'RFC']);

        $query = $query->with('customerStatus');

        $customers = $query->get();

        return ApiResponse::success($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customerStatus = CustomerStatus::find($request->customer_status_id);

        if (!$customerStatus) {
            return ApiResponse::error('Invalid Customer Status.');
        }

        $data = $request->validated();

        //TODO: Assign createdby and updatedby to auth user and validate
        //Por ahora hay que correr db:seed antes

        // $data['created_by'] = User::first()->user_id;
        // $data['updated_by'] = User::first()->user_id;

        $customer = Customer::create($data);

        return ApiResponse::created($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return ApiResponse::notFound('Customer not found.');
        }

        return ApiResponse::success($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CustomerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return ApiResponse::notFound('Customer not found.');
        }

        $customer->update($request->validated());
        return ApiResponse::updated($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return ApiResponse::notFound('Customer not found.');
        }

        $customer->delete();
        return ApiResponse::deleted('Customer deleted successfully.');
    }

    /** DEPRECATED
     * Get either: locations from a customer | contacts from a location
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $customerId
     * @param  int $locationId
     * @return \Illuminate\Http\JsonResponse $contacts | $locations
     */
    // public function getCustomerData(Request $request, $customerId = null, $locationId = null)
    // {
    //     if ($customerId && $locationId) {
    //         $contacts = CustomerLocationContact::where('customer_location_id', $locationId)
    //             ->where('is_active', 1)
    //             ->whereNull('deleted_at')
    //             ->get();
    //         return ApiResponse::success($contacts);
    //     } elseif ($customerId) {
    //         $locations = CustomerLocation::with(['locationType'])
    //             ->where('customer_id', $customerId)
    //             ->where('is_active', 1)
    //             ->whereNull('deleted_at')
    //             ->get();
    //         return ApiResponse::success($locations);
    //     }

    //     return ApiResponse::notFound('Invalid request, please provide a customer ID and/or location ID');
    // }

}
