<?php

namespace App\Http\Controllers;

use App\Events\ProfileSwitchEvent;
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


        Session([
            'activeProfileType' => User::class,
            'activeProfileId' => auth()->user()->id,
            'activeProfileName'=> auth()->user()->name,
            'activeProfilePhoto'=> auth()->user()->profile_photo_path
        ]);


            //TODO: Add special welcom text on ow to get started
        return redirect()->route('dashboard');

    }
}

