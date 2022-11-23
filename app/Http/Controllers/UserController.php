<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('manage users');
        return view('admin.users-overview');
    }
}
