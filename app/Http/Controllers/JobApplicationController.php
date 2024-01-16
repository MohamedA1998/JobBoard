<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Notifications\TellEmployerNewApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{

    public function create(Job $job)
    {
        $this->authorize('apply' , $job);

        return view('job_application.create' , ['job' => $job]);
    }

    public function store(Request $request , Job $job)
    {
        $this->authorize('apply' , $job);

        $validatedData = $request->validate([
            'expected_salary'   => 'required|min:1|max:1000000' ,
            'cv'                => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs' , 'private');

        $jobApplication = $job->jobApplications()->create([
            'user_id'           => $request->user()->id ,
            'expected_salary'   => $validatedData['expected_salary'] ,
            'cv_path'           => $path
        ]);

        // Tell Employer Some One Make New Application
        $job->employer->user->notify(new TellEmployerNewApplication($jobApplication));

        return redirect()->route('jobs.show' , $job)
                ->with('success' , 'Job Applicateion Submitted.');
    }

    public function destroy(string $id)
    {
        //
    }
}
