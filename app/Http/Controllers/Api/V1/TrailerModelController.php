<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TrailerModel;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrailerModelRequest;

class TrailerModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TrailerModel::query();

        $query = QueryFilter::Filter($request, $query);

        $trailerModels = $query->get();

        return ApiResponse::success($trailerModels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TrailerModelRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrailerModelRequest $request)
    {
        $trailerModel = TrailerModel::create($request->validated());

        return ApiResponse::created($trailerModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trailerModel = TrailerModel::find($id);

        if (!$trailerModel) {
            return ApiResponse::notFound('TrailerModel not found');
        }

        return ApiResponse::success($trailerModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TrailerModelRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TrailerModelRequest $request, $id)
    {
        $trailerModel = TrailerModel::find($id);

        if (!$trailerModel) {
            return ApiResponse::notFound('TrailerModel not found');
        }

        $trailerModel->update($request->validated());

        return ApiResponse::updated($trailerModel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $trailerModel = TrailerModel::find($id);

        if (!$trailerModel) {
            return ApiResponse::notFound('TrailerModel not found');
        }

        $trailerModel->delete();

        return ApiResponse::deleted('TrailerModel deleted successfully');
    }
}
