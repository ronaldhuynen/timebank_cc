<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OrgController;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
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


    public function show($userId)
    {
        $user = User::select([
            'id',
            'name',
            'profile_photo_path',
            'about',
            'motivation',
            'date_of_birth',
            'website',
            'phone_public_for_friends',
            'lang_preference',
            'created_at',
            'last_login_at',
            'love_reactant_id'
        ])
        ->with([
            'organizations:id,name,profile_photo_path',
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
        ->find($userId);

        if ($user->count() >= 1) {

            $user->likedCounter =  $user->loveReactant->reactionCounters->first() ? (int)$user->loveReactant->reactionCounters->first()->weight : null;
            $registerDate = Carbon::createFromTimeStamp(strtotime($user->created_at))->isoFormat('LL');
            $lastLoginDate = Carbon::createFromTimeStamp(strtotime($user->last_login_at))->isoFormat('LL');

        } else {
            return view('profile-user.not_found');
        }

        //TODO: add permission check
        //TODO: if 403, but has permission, redirect with message to switch profile
        //TODO: replace 403 with custom redirect page incl explanation
        return ($user != null ? view('profile-user.show', compact(['user'])) : abort(403));
    }

    public function showByName($name)
    {
        $user = User::where('name', $name)->first();
        if ($user) {
            $userId = $user->id;
        }


        $organization = Organization::where('name', $name)->first();
        if ($organization) {
            $orgId = $organization->id;
        }

        if ($user) {
            return $this->show($userId);
        }

        if ($organization) {
            return (new OrgController())->show($orgId);
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile-user.edit');
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
