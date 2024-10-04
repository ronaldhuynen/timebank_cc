<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileUserController extends Controller
{
    public function show($id, $model)
    {
        dd($model);
        // return view('profile-user.show');
        // return view('profile-user.show');
    }

}
