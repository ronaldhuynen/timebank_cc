<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Transaction extends Model implements Searchable
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';


    public function accountFrom()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function accountTo()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }


    // Spatie Laravel-Searchable
    public function getSearchResult(): SearchResult
    {
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->amount,
            $this->description,
         );
     }

}
