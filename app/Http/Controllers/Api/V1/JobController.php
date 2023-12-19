<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Job;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\QueryFilter;
use App\Http\Requests\JobRequest;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Job::query();

        $query = QueryFilter::Filter($request, $query);

        $query = QueryFilter::Search($request, $query, ['job_code', 'job_name']);

        $query = $query->with('department');

        $jobs = $query->get();

        return ApiResponse::success($jobs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(JobRequest $request)
    {
        $department = Department::find($request->department_id);

        if(!$department) {
            return ApiResponse::error('Invalid Department');
        }

        $job = Job::create($request->validated());
        return ApiResponse::created($job);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return ApiResponse::notFound('Job not found');
        }

        return ApiResponse::success($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(JobRequest $request, $id)
    {
        $job = Job::find($id);

        if (!$job) {
            return ApiResponse::notFound('Job not found');
        }

        $job->update($request->validated());
        return ApiResponse::updated($job);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return ApiResponse::notFound('Job not found');
        }

        $job->delete();
        return ApiResponse::deleted('Job deleted successfully');
    }
}
