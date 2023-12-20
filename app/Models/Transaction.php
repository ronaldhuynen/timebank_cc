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


    /**
     * Convert the transaction model to a searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'amount' => $this->amount, 
            'account_from_name' => $this->accountFrom->name,    // Include also relationship in search
            'account_to_name' => $this->accountTo->name,    // Include also relationship in search
            'relation_from' => 'From ' . ($this->accountFrom->accountable->name != null ? $this->accountFrom->accountable->name : ''), // Include also relationship in search
            'relation_to' => 'To ' . ($this->accountTo->accountable->name != null ? $this->accountTo->accountable->name : ''), // Include also relationship in search
            'description' => $this->description,
        ];
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
