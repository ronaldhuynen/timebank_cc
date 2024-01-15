<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show()
    {
        
        // Retrieve the results from the session
        $results = session('results', []);

        return view('search.show', ['results' => $results]);
    }
}
