<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $this->authorize('viewAnyEmployer' , Job::class);

        return view('my_job.index' , [
                'jobs' => auth()->user()->employer->jobs()
                            ->with(['employer' , 'jobApplications' , 'jobApplications.user'])
                            ->withTrashed()
                            ->get()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $this->authorize('create' , Job::class);

        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request):RedirectResponse
    {
        $this->authorize('create' , Job::class);

        $request->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')->with('success' , 'Job Created Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob):View
    {
        $this->authorize('update' , $myJob);

        return view('my_job.edit' , [
            'job' => $myJob
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob):RedirectResponse
    {
        $this->authorize('update' , $myJob);

        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')->with('success' , 'Job Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob):RedirectResponse
    {
        $myJob->delete();

        return redirect()->route('my-jobs.index')->with('success' , 'Job Deleted.');
    }
}
