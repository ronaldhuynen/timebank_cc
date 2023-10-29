<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingFriend extends Model
{
    use HasFactory;

     /**
     * @var string
     */
    protected $table = 'pending_friends';

    /**
     * @var array
     */
    protected $guarded = [];


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    
    public function sender()
    {
        return $this->morphTo();
    }


    public function recipient()
    {
        return $this->morphTo();
    }
}
