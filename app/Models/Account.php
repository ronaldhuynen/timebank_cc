<?php

namespace App\Models;

use App\Models\Transaction;
use App\Traits\AccountInfoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    use AccountInfoTrait;


    protected $fillable = [];
    protected $table = 'accounts';

    // Get all of the owning accountable tables: users and organizations
    // One-to-many polymorphic
    public function accountable()
    {
        return $this->morphTo();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
