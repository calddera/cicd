<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\CustomerStatus;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStatusRequest;

class CustomerStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CustomerStatus::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['customer_status_name']);

        $customerStatuses = $query->get();

        return ApiResponse::success($customerStatuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CustomerStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStatusRequest $request)
    {
        $customerStatus = CustomerStatus::create($request->validated());
        return ApiResponse::created($customerStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerStatus = CustomerStatus::find($id);
        if (!$customerStatus) {
            return ApiResponse::notFound('CustomerStatus not found.');
        }
        return ApiResponse::success($customerStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CustomerStatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerStatusRequest $request, $id)
    {
        $customerStatus = CustomerStatus::find($id);

        if (!$customerStatus) {
            return ApiResponse::notFound('CustomerStatus not found.');
        }

        $customerStatus->update($request->validated());
        return ApiResponse::updated($customerStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerStatus = CustomerStatus::find($id);

        if (!$customerStatus) {
            return ApiResponse::notFound('CustomerStatus not found.');
        }

        $customerStatus->delete();
        return ApiResponse::deleted('CustomerStatus deleted successfully.');
    }
}
