<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;

class EstadoController extends Controller
{
    //

    public function index(Request $request) {
        $query = Estado::query();
        $query = QueryFilter::Filter($request, $query);
        $query = QueryFilter::Search($request, $query, ['job_code', 'job_name']);
        $estados = $query->get();

        return ApiResponse::success($estados);
    }
}
