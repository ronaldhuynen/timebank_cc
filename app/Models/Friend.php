<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'friends';

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


    public function owner()
    {
        return $this->morphTo();
    }


    public function party()
    {
        return $this->morphTo();
    }

}
