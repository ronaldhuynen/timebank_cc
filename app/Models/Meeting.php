<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Meeting extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['post_id', 'address', 'meetingable_id', 'meetingable_type', 'status', 'from', 'till'];


    /**
     * Get related post for this event
     * Ont-to-one relationship
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    /**
     * Get the organizer of the meeting (i.e. user or organization).
     *
     * @return void
     */
    public function meetingable()
    {
        return $this->morphTo();
    }
    
}
