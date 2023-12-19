<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Truck;
use App\Models\Document;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\TruckDocument;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TruckDocumentRequest;

class TruckDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = TruckDocument::query();

        $query = QueryFilter::Filter($request, $query);

        $truckDocuments = $query->get();

        return ApiResponse::success($truckDocuments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TruckDocumentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TruckDocumentRequest $request)
    {
        $truck = Truck::find($request->truck_id);

        if (!$truck) {
            return ApiResponse::error('Invalid Truck.');
        }

        $document = Document::find($request->document_id);

        if (!$document) {
            return ApiResponse::error('Invalid document');
        }

        $truckDocument = new TruckDocument($request->validated());
        
        if($request->file) {
            $filePath = Helper::uploadBase64File('trucks', $request->file);
            $truckDocument->file_path = $filePath;
        }
        
        //TODO: Assign createdby and updatedby to auth user and validate
        //Por ahora hay que correr db:seed antes

        // $data['created_by'] = User::first()->user_id;
        // $data['updated_by'] = User::first()->user_id;

        $truckDocument->save();

        return ApiResponse::created($truckDocument);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $truckDocument = TruckDocument::find($id);

        if (!$truckDocument) {
            return ApiResponse::notFound('TruckDocument not found.');
        }

        return ApiResponse::success($truckDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TruckDocumentRequest $request, $id)
    {
        $truckDocument = TruckDocument::find($id);

        if (!$truckDocument) {
            return ApiResponse::notFound('TruckDocument not found.');
        }

        // TODO: Assign updatedby to auth user

        $truckDocument->update($request->validated());

        if($request->file) {
            $filePath = Helper::uploadBase64File('trucks', $request->file);
            $truckDocument->file_path = $filePath;
        }

        $truckDocument->save();

        return ApiResponse::updated($truckDocument);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $truckDocument = TruckDocument::find($id);

        if (!$truckDocument) {
            return ApiResponse::notFound('TruckDocument not found.');
        }
        
        $truckDocument->delete();

        return ApiResponse::deleted('TruckDocument deleted successfully.');
    }

    public function downloadTruckDocument($id)
    {
        $truckDocument = TruckDocument::find($id);

        if (!$truckDocument) {
            return ApiResponse::notFound('TruckDocument not found.');
        }

        return Storage::download('public/' . $truckDocument->file_path);
    }
}
