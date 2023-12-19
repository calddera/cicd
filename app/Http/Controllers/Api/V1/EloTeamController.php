<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EloTeam;
use App\Http\Requests\EloTeamRequest;
use App\Http\Helpers\ApiResponse;

class EloTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $eloTeams = EloTeam::all();
        return ApiResponse::success($eloTeams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EloTeamRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EloTeamRequest $request)
    {
        $eloTeam = EloTeam::create($request->validated());
        return ApiResponse::created($eloTeam);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $eloTeam = EloTeam::find($id);
        if (!$eloTeam) {
            return ApiResponse::notFound('EloTeam not found');
        }
        return ApiResponse::success($eloTeam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $eloTeam = EloTeam::find($id);
        if (!$eloTeam) {
            return ApiResponse::notFound('EloTeam not found');
        }
        $eloTeam->update($request->all());
        return ApiResponse::updated($eloTeam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $eloTeam = EloTeam::find($id);
        if (!$eloTeam) {
            return ApiResponse::notFound('EloTeam not found');
        }
        $eloTeam->delete();
        return ApiResponse::deleted('EloTeam deleted successfully');
    }
}
