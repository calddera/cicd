<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Colonia;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;

class ColoniaController extends Controller
{
    //

    public function index(Request $request) {

        $query = Colonia::query();
        $query = QueryFilter::Filter($request, $query);
        $query = QueryFilter::Search($request, $query, ['nombre']);
        $colonias = $query->get();

        return ApiResponse::success($colonias);
    }
}
