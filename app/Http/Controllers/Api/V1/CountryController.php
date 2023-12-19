<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;

class CountryController extends Controller
{
    //

    public function index(Request $request) {

        $query = Country::query();
        $query = QueryFilter::Filter($request, $query);
        $query = QueryFilter::Search($request, $query, ['country_name', 'country_key']);
        $countries = $query->get();

        return ApiResponse::success($countries);
    }
}
