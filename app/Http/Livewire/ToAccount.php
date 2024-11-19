<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ToAccount extends Component
{
    use LocationTrait;
    
    public $label;
    public $search;
    public $searchResults = [];
    public $showDropdown = false;
    public $fromAccountId;
    public $toAccountId;
    public $toAccountName;
    public $toHolderName;
    public $toHolderFullName;
    public $toHolderLocation;
    public $toHolderType;
    public $toHolderPhoto;
    public $userAccounts;

    protected $listeners = ['fromAccountId', 'resetForm', 'removeSelectedAccount'];

    public function mount($toHolderName = null, $toAccountId = null)
    {
        if ($toHolderName) {
            $this->showDropdown = true;
            $this->search = $toHolderName;
            $this->updatedSearch();
        }

        if ($toAccountId && !($toAccountId instanceof \Illuminate\Support\Collection)) {
            $this->updatedSearch();
            $this->toAccountSelected($toAccountId);
        }
    }

    public function checkValidation()
    {
        $this->dispatch('toAccountId', $this->toAccountId);
    }

    public function resetForm()
    {   // Reset all properties except $label
        $this->reset([
            'search', 
            'searchResults', 
            'showDropdown',
            'fromAccountId',
            'toAccountId',
            'toAccountName',
            'toHolderName',
            'toHolderType',
            'toHolderPhoto',
            'userAccounts'
        ]);
    }

    // Needed to exclude this account from the available to account options
    public function fromAccountId($fromAccount)
    {
        $this->fromAccountId = $fromAccount;
    }

    public function toHolderName($toHolderName)
    {
        $this->updatedSearch($toHolderName);
    }

    public function toAccountSelected($toAccountId)
    {
        $this->toAccountId = $toAccountId;
        $toAccountDetails = collect($this->searchResults)->firstWhere('accountId', $toAccountId);
        
        if ($toAccountDetails) {
            $this->toAccountName = $toAccountDetails['accountName'];
            $this->toHolderName = $toAccountDetails['holderName'];
            $this->toHolderFullName = $toAccountDetails['holderFullName'];
            $this->toHolderLocation = $toAccountDetails['holderLocation'];
            $this->toHolderType = $toAccountDetails['holderType'];
            $this->toHolderPhoto = $toAccountDetails['holderPhoto'];
            $this->dispatch('toAccountDetails', $toAccountDetails);
        } else {
            // Handle the case where $toAccountDetails is null
            $this->toAccountName = null;
            $this->toHolderName = null;
            $this->toHolderFullName = null;
            $this->toHolderLocation = null;
            $this->toHolderType = null;
            $this->toHolderPhoto = null;
            $this->dispatch('toAccountDetails', null);
        }
        $this->search = '';
    }

    /**
     * updatedSearch: Search query To Accounts
     *
     * @param  mixed $newValue
     * @return void
     */
    public function updatedSearch()
    {
        $excludeAccount = $this->fromAccountId;
        $search = $this->search;

        // Find the accounts that are currently not inactive,
        // note that accounts can be set to inactive for a the future datetime.
        if ($search) {
            $this->showDropdown = true;
            $accounts = Account::with('accountable')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')->orWhereHas('accountable', function (Builder $query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('full_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                    });
                })
                ->where(function ($query) {
                    $query->whereNull('inactive_at')
                        ->orWhere('inactive_at', '>', now());
                }) 
                // Exclude accountables where that haven't confirmed their email or are set to inactive
                ->whereDoesntHave('accountable', function (Builder $query) {
                    $query->where('email_verified_at', null)
                    ->orWhere('inactive_at', '<', now());
                })
                ->get();
        } else {
            // No search, because a toAccountId is already known
            $accounts = Account::with('accountable')
                ->where('id', $this->toAccountId)
                ->where(function ($query) {
                    $query->whereNull('inactive_at')
                        ->orWhere('inactive_at', '>', now());
                }) 
                ->get();
        }


        $mappedAccounts = $accounts
            ->map(function ($account) {
                return [
                    'accountId' => $account->id,
                    'accountName' => $account->name,
                    'holderId' => $account->accountable->id,
                    'holderName' => $account->accountable->name,
                    'holderFullName' => $account->accountable->full_name,
                    'holderLocation' => $account->accountable->getLocationFirst()['name_short'],
                    'holderType' => $account->accountable_type,
                    'holderPhoto' => url(Storage::url($account->accountable->profile_photo_path)),
                ];
            })
            ->whereNotIn('accountId', $excludeAccount)
            // Sort the collection by 'holderName'
            ->sortBy(function ($account) {
                return strtolower($account['holderName']);
            })
            // Re-index the collection keys
            ->values();

        $response = $mappedAccounts->take(6);


        $this->searchResults = $response;
    }


    public function removeSelectedAccount()
    {            
        $this->toAccountId = null;
        $this->toHolderName = null;
        $this->dispatch('toAccountId', null);
        $this->dispatch('toAccountDetails', null);
    }


    public function render()
    {
        $this->updatedSearch($this->search);
        return view('livewire.to-account');
    }
}
