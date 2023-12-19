<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\EmployeeDocument;
use App\Http\Requests\EmployeeDocumentRequest;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class EmployeeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = EmployeeDocument::query();
        $query = QueryFilter::Filter($request, $query);

        $query = $query->with('document');

        $employeeDocuments = $query->get();

        return ApiResponse::success($employeeDocuments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EmployeeDocumentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeDocumentRequest $request)
    {
        $filePath = "";
        if ($request->file) {
            $filePath = Helper::uploadBase64File('employees', $request->file);
        }

        $data = $request->validated();
        $data["file_path"] = $filePath;

        $document = EmployeeDocument::create($data);
        return ApiResponse::created($document);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $document = EmployeeDocument::find($id);
        if (!$document) {
            return ApiResponse::notFound('Employee document not found');
        }
        return ApiResponse::success($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployeeDocumentRequest $request, $id)
    {
        $document = EmployeeDocument::find($id);
        if (!$document) {
            return ApiResponse::notFound('Employee document not found');
        }

        $filePath = "";
        if ($request->file) {
            $filePath = Helper::uploadBase64File('employees', $request->file);
        }

        $data = $request->validated();
        $data["file_name"] = explode('/', $filePath)[1];
        $data["file_path"] = $filePath;

        $document->update($data);

        return ApiResponse::updated($document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $document = EmployeeDocument::find($id);
        if (!$document) {
            return ApiResponse::notFound('Employee document not found');
        }
        $document->delete();
        return ApiResponse::deleted('Employee document deleted successfully');
    }

    public function downloadEmployeeDocument($id)
    {
        $employeeDocument = EmployeeDocument::find($id);

        if (!$employeeDocument) {
            return ApiResponse::notFound('EmployeeDocument not found.');
        }

        return Storage::download('public/' . $employeeDocument->file_path);
    }

    public function downloadMultipleEmployeeDocument(Request $request)
    {
        if ($request->employee_document_ids) {
            $employeeDocuments = EmployeeDocument::whereIn('employee_document_id', $request->employee_document_ids)->get();

            $zip = new ZipArchive;
            $fileName = 'documentos_empleado_tmp.zip';
            $result = $zip->open(storage_path("app/public/" . $fileName), ZipArchive::CREATE) === TRUE;
            if ($result) {
                foreach ($employeeDocuments as $doc) {
                    $relativeName = basename($doc->file_name);
                    $fileToAdd = storage_path("app/public/" . $doc->file_path);
                    $zip->addFile($fileToAdd, $relativeName);
                }
                $zip->close();
            }
            return
                response()
                ->download(storage_path("app/public/" . $fileName))
                ->deleteFileAfterSend(true);
        }

        return;
    }
}
