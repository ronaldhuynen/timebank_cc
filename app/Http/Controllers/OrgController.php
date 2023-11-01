<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrgController extends Controller
{
        /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


   public function show($orgId)
    {
        $org = Organization::select([
            'id',
            'name',
            'profile_photo_path',
            'about',
            'motivation',
            'date_of_birth',
            'website',
            'phone_public_for_friends',
            'created_at',
            'last_login_at',
            'love_reactant_id'
        ])
        ->with([
            'users:id,name,profile_photo_path',
            'accounts:id,name,accountable_type,accountable_id',
            'languages:id,name,lang_code,flag',
            'socials:id,name,icon,urL_structure',
            'locations.district.locale:district_id,name',
            'locations.city.locale:city_id,name',
            'locations.division.locale:division_id,name',
            'locations.country.locale:country_id,name',
            'loveReactant.reactions.reacter.reacterable',
            // 'loveReactant.reactions.type',
            'loveReactant.reactionCounters',
            // 'loveReactant.reactionTotal',
        ])
        ->find($orgId);

        if ($org->count() >= 1) {

            $org->likedCounter =  $org->loveReactant->reactionCounters->first() ? (int)$org->loveReactant->reactionCounters->first()->weight : null;
            $registerDate = Carbon::createFromTimeStamp(strtotime($org->created_at))->isoFormat('LL');
            $lastLoginDate = Carbon::createFromTimeStamp(strtotime($org->last_login_at))->isoFormat('LL');

        } else {
            return view('profile-user.not_found');
        }

        ds($org)->label('$org in OrgController');

        //TODO: add permission check
        //TODO: if 403, but has permission, redirect with message to switch profile
        //TODO: replace 403 with custom redirect page incl explanation
        return ($org != null ? view('profile-user.show', compact(['org'])) : abort(403));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile-org.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
