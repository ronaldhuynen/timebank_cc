<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function manage()
    {    
        if (getActiveProfileType() !== 'Admin') {
            abort(403, __('Admin profile required'));
        }

        return view('tags.manage');
    }
}
