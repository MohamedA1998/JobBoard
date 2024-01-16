<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employer::class);
    }

    public function create():View
    {
        return view('employer.create');
    }

    public function store(Request $request):RedirectResponse
    {
        $request->user()->employer()->create(
            $request->validate([
                'company_name'  => 'required|min:3|unique:employers,company_name'
            ])
        );

        return redirect()->route('jobs.index')->with('success' , 'Your Company Was Created');
    }

}
