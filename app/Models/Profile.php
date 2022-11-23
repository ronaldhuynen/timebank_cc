<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Jetstream\HasProfilePhoto;


class Profile extends Model
{
    use HasFactory;

   //The attributes that are mass assignable.
    // protected $fillable = [
    //     'profile_photo_path',
    // ];


    // protected $appends = [
    //     'profile_photo_url',
    // ];



    // Get all of the owning user
    // One-to-one
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
