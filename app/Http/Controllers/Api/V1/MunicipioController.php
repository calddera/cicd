<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;

class MunicipioController extends Controller
{
    //

    public function index(Request $request) {

        $query = Municipio::query();
        $query = QueryFilter::Filter($request, $query);
        $query = QueryFilter::Search($request, $query, ['nombre']);
        $countries = $query->get();

        return ApiResponse::success($countries);
    }
}
