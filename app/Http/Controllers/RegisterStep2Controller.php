<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterStep2Controller extends Controller
{
    public function create()
    {
        return view('auth.register-step2');
    }


    public function store(Request $request)
    {
        auth()->user()->update([
            'about' => $request->about,
            'motivation' => $request->motivation,
            'date_of_birth' => $request->date_of_birth
        ]);

        if ($request->hasFile('photo')) {
            auth()->user()->updateProfilePhoto($request->photo);
        }

        // Final action before registration is complete.
        // Always move this section to the final registration step.
        Session([
            'activeProfileType' => User::class,
            'activeProfileId' => auth()->user()->id,
            'activeProfileName'=> auth()->user()->name,
            'activeProfilePhoto'=> auth()->user()->profile_photo_path,
            'firstLogin' => true
        ]);
        //TODO: Welcome and introduction with Session('firstLogin') on rest of site views
        return redirect()->route('dashboard');

    }
}

