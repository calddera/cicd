<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Trailer;
use App\Models\Document;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\TrailerDocument;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrailerDocumentRequest;

class TrailerDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TrailerDocument::query();

        $query = QueryFilter::Filter($request, $query);

        $query = $query->with('document');
        
        $trailerDocuments = $query->get();

        return ApiResponse::success($trailerDocuments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TrailerDocumentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TrailerDocumentRequest $request)
    {
        $trailer = Trailer::find($request->trailer_id);

        if (!$trailer) {
            return ApiResponse::error('Invalid trailer.');
        }

        $document = Document::find($request->document_id);

        if (!$document) {
            return ApiResponse::error('Invalid document');
        }

        $trailerDocument = new TrailerDocument($request->validated());
        
        if($request->file) {
            $filePath = Helper::uploadBase64File('trailers', $request->file);
            $trailerDocument->file_path = $filePath;
        }

        
        //TODO: Assign createdby and updatedby to auth user and validate
        //Por ahora hay que correr db:seed antes

        // $data['created_by'] = User::first()->user_id;
        // $data['updated_by'] = User::first()->user_id;

        $trailerDocument->save();

        return ApiResponse::created($trailerDocument);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $trailerDocument = TrailerDocument::find($id);

        if (!$trailerDocument) {
            return ApiResponse::notFound('TrailerDocument not found.');
        }

        return ApiResponse::success($trailerDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TrailerDocumentRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TrailerDocumentRequest $request, $id)
    {
        $trailerDocument = TrailerDocument::find($id);

        if (!$trailerDocument) {
            return ApiResponse::notFound('TrailerDocument not found.');
        }

        // TODO: Assign updatedby to auth user

        $trailerDocument->update($request->validated());

        if($request->file) {
            $filePath = Helper::uploadBase64File('trailers', $request->file);
            $trailerDocument->file_path = $filePath;
        }

        $trailerDocument->save();

        return ApiResponse::updated($trailerDocument);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $trailerDocument = TrailerDocument::find($id);

        if (!$trailerDocument) {
            return ApiResponse::notFound('TrailerDocument not found.');
        }
        
        $trailerDocument->delete();

        return ApiResponse::deleted('TrailerDocument deleted successfully.');
    }

    public function downloadTrailerDocument($id)
    {
        $trailerDocument = TrailerDocument::find($id);

        if (!$trailerDocument) {
            return ApiResponse::notFound('TrailerDocument not found.');
        }

        //dd(Storage::disk('public')->exists($trailerDocument->file_path));  

        return Storage::download('public/' . $trailerDocument->file_path);
    }
}
