<?php

namespace App\Http\Controllers;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location as IpLocation;

class UserController extends Controller
{
    /**
     * Test Stevbauman/Location package
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $ip = $request->ip(); // Dynamic IP address
        // dd($ip);
        $ip = '103.75.231.255'; // Static IP address
        $currentUserInfo = IpLocation::get($ip);

        return view('test.ip-location', compact('currentUserInfo'));
    }
}
