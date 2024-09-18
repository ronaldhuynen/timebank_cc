<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ToAccount extends Component
{
    public $search;
    public $searchResults = [];
    public $showDropdown = false;
    public $fromAccountId;
    public $toAccountId;
    public $toAccountName;
    public $toHolderName;
    public $toHolderPhoto;
    public $userAccounts;

    protected $listeners = ['fromAccountId', 'resetForm'];

    public function mount($toHolderName = null)
    {
        if ($toHolderName) {
            $this->showDropdown = true;
            $this->updatedSearch($toHolderName);
            $this->search = $toHolderName;
        }
    }

    public function checkValidation()
    {
        $this->dispatch('toAccountId', $this->toAccountId);
    }

    public function resetForm()
    {
        $this->reset();
    }


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
        $toAccountDetails = collect($this->searchResults)
            ->where('accountId', '=', $toAccountId)
            ->first();
        $this->toAccountName = $toAccountDetails['accountName'];
        $this->toHolderName = $toAccountDetails['holderName'];
        $this->toHolderPhoto = $toAccountDetails['holderPhoto'];
        $this->showDropdown = false;
        $this->search = '';
        $this->dispatch('toAccountDetails', $toAccountDetails);
        $this->dispatch('toAccountId', $this->toAccountId);
    }

    /**
     * updatedSearch: Search query To Accounts
     *
     * @param  mixed $newValue
     * @return void
     */
    public function updatedSearch()
    {
        $this->showDropdown = true;
        $excludeAccount = $this->fromAccountId;
        $search = $this->search;
        $accounts = Account::with('accountable')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhereHas('accountable', function (Builder $query) use ($search) {
                          $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                      });
            })
            ->whereNull('owner_deleted_at')
            ->get();

        $mappedAccounts = $accounts->map(function ($account, $key) {
            return [
                'accountId' => $account->id,
                'accountName' => $account->name,
                'holderId' => $account->accountable->id,
                'holderName' => $account->accountable->name,
                'holderPhoto' => url(Storage::url($account->accountable->profile_photo_path)),
            ];
        })->whereNotIn('accountId', $excludeAccount);

        $response = $mappedAccounts->take(6);

        $this->searchResults = $response;
    }


    public function removeSelectedAccount()
    {
        $this->toAccountId = null;
        $this->dispatch('toAccountId', $this->toAccountId);
    }


    public function render()
    {
        $this->updatedSearch($this->search);
        return view('livewire.to-account');
    }
}
