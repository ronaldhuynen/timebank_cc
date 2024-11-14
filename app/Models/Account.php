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

    // Define the relationship for transactions where the account is the sender
    public function transactionsFrom()
    {
        return $this->hasMany(Transaction::class, 'from_account_id');
    }

    // Define the relationship for transactions where the account is the receiver
    public function transactionsTo()
    {
        return $this->hasMany(Transaction::class, 'to_account_id');
    }

    // Define a combined relationship for all transactions involving the account
    public function transactions()
    {
        return $this->transactionsFrom()->union($this->transactionsTo());
    }

    public static function accountsCyclosMember($cyclos_id)
    {
        return  Account::with('accountable')
                    ->whereHas('accountable', function ($query) use ($cyclos_id) {
                        $query->where('cyclos_id', $cyclos_id)
                            ->whereNull('inactive_at');
                    })
                    ->pluck('name', 'id');

    }
    
    //get all accounts owned by the same accountable
    public function getAccountsBySameAccountable()
    {
        return Account::where('accountable_id', $this->accountable_id)
                      ->where('accountable_type', $this->accountable_type)
                      ->get();
    }
}
