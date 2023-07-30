<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileOrgController extends Controller
{
    public function show()
    {
        return view('profile-organization.show');
    }

}
