<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->document_type_name) {
            $documentType = DocumentType::where('document_type_name', $request->document_type_name)->first();

            if (!$documentType) {
                return ApiResponse::error('Documents with that document type does not exist');
            }
            $documents = $documentType->documents;
        } else {
            $query = Document::query();

            $query = QueryFilter::Filter($request, $query);
    
            // Obtener los resultados
            $documents = $query->get();
        }

        return ApiResponse::success($documents);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DocumentRequest $request)
    {
        $document = Document::create($request->validated());
        return ApiResponse::created($document, 'Document created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $document = Document::find($id);
        if (!$document) {
            return ApiResponse::notFound('Document not found.');
        }
        return ApiResponse::success($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DocumentRequest $request, $id)
    {
        $document = Document::find($id);
        if (!$document) {
            return ApiResponse::notFound('Document not found.');
        }
        $document->update($request->validated());
        return ApiResponse::updated($document, 'Document updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        if (!$document) {
            return ApiResponse::notFound('Document not found.');
        }
        $document->delete();
        return ApiResponse::deleted('Document deleted successfully.');
    }
}
