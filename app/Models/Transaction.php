<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Transaction extends Model
{
    use HasFactory;
    use Searchable; // laravel/scout with ElasticSearch


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'transactions_index';
    }


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


}
