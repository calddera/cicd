<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use App\Http\Requests\DocumentTypeRequest;
use App\Http\Helpers\ApiResponse;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $documentTypes = DocumentType::all();
        return ApiResponse::success($documentTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentTypeRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DocumentTypeRequest $request)
    {
        $documentType = DocumentType::create($request->validated());
        return ApiResponse::created($documentType);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $documentType = DocumentType::find($id);
        if (!$documentType) {
            return ApiResponse::notFound('DocumentType not found');
        }
        return ApiResponse::success($documentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DocumentTypeRequest $request, $id)
    {
        $documentType = DocumentType::find($id);
        if (!$documentType) {
            return ApiResponse::notFound('DocumentType not found');
        }
        $documentType->update($request->all());
        return ApiResponse::updated($documentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $documentType = DocumentType::find($id);
        if (!$documentType) {
            return ApiResponse::notFound('DocumentType not found');
        }
        $documentType->delete();
        return ApiResponse::deleted('DocumentType deleted successfully');
    }
}
