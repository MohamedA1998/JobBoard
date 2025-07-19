<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FcmNotification;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fcm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = User::find(1);
        
        $admin->update(['device_token' => request('TOKEN')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = User::find(1);

        $admin->notify(new FcmNotification('WELCOME TO FCM', 'THIS MESSAGE IS FROM FCM'));
        
        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
