<?php

namespace App\Http\Controllers;

class LocationController extends Controller
{
    public static function Districts()
    {
        return District::orderBy('name', 'asc')->get();
    }

    public static function Cities()
    {
        return City::orderBy('name', 'asc')->get();
    }

    public static function Divisions()
    {
        return Division::orderBy('name', 'asc')->get();
    }

    public static function Countries()
    {
        return Country::orderBy('name', 'asc')->get();
    }
}
