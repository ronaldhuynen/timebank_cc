<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Stevebauman\Location\Facades\Location as IpLocation;


class TestController extends Controller
{
    /**
    * Test Stevbauman/Location package
    *
    * @return \Illuminate\Http\Response
    */

    
    public function viewIpLocation(Request $request)
    {
        if (App::environment(['local', 'staging'])) {
            $ip = '103.75.231.255'; // Static IP address Brussels for testing
            // $ip = '31.20.250.12'; // Statis IP address The Hague for testing
            // $ip = '102.129.156.0'; // Statis IP address Berlin for testing
        } else {
            $ip = $request->ip(); // Dynamic IP address
        }
        $IpLocationInfo = IpLocation::get($ip);
        // TODO: Test for correct ip address in production mode.
        // dd($ipLocatonInfo);
        // TODO: Enable alternative IpLocation info providers.
        return view('test.ip-location', compact('IpLocationInfo'));
    }


    public function viewDebug1(Request $request)
    {
        return view('test.debug-1');
    }

    
    public function clearCache()
    {   
        Artisan::call('cache:clear');
        return "Cache is cleared";
    }

    public function optimizeClear()
    {
        Artisan::call('optimize:clear');
        return "Events, views, caches, routes, configs cleared";
    }
}