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

    public function __construct(array $attributes = [])
    {
            // // Log the attributes being passed to the constructor
            // info('Transaction model constructor called with attributes: ', $attributes);

            // parent::__construct($attributes);

            // // Log the state of the model after instantiation
            // info('Transaction model instantiated with ID: ' . ($this->id ?? 'N/A'), [
            //     'attributes' => $this->getAttributes(),
            // ]);
    }


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
        // Log the start of the method
        // info('toSearchableArray method called for Transaction ID: ' . $this->id);

        // Eager load relationships
        $this->load(['accountFrom.accountable', 'accountTo.accountable']);

        // Extract relationship data safely
        $accountFrom = $this->accountFrom;
        $accountTo = $this->accountTo;

        $accountFromName = $accountFrom->name ?? '';
        $accountToName = $accountTo->name ?? '';

        $relationFromName = $accountFrom && $accountFrom->accountable ? $accountFrom->accountable->first()->name ?? '' : '';
        $relationToName = $accountTo && $accountTo->accountable ? $accountTo->accountable->first()->name ?? '' : '';

        // Log the loaded relationships for debugging
        // info('Account From:', ['accountFrom' => $accountFrom]);
        // info('Account To:', ['accountTo' => $accountTo]);

        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'from_account_id' => $this->accountFrom,
            'to_account_id' => $this->accountTo,
            'amount' => $this->amount,
            'account_from_name' => $accountFromName,
            'account_to_name' => $accountToName,
            'relation_from' => 'From ' . $relationFromName,
            'relation_to' => 'To ' . $relationToName,
            'description' => $this->description ?? '',
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
