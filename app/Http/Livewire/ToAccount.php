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


    protected $listeners = [
        'fromAccountId',
        'resetForm'
    ];


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
        $this->emit('toAccountValidation');
    }

    public function resetForm()
    {
        $this->reset();
    }


    public function updatedSelected()
    {
        $this->emitSelf('toAccountSelected', $this->selected);
    }


    public function fromAccountId($fromAccount)
    {
        $this->fromAccountId = $fromAccount;
    }


    public function toHolderName($toHolderName)
    {
        $this->updatedSearch($toHolderName);
    }


    public function toAccountSelected($toAccount)
    {
        $this->toAccountId = $toAccount;
        $toAccountDetails = collect($this->searchResults)->where('accountId', '=', $toAccount)->first();
        $this->emit('toAccountDetails', $toAccountDetails);
        $this->toAccountName = $toAccountDetails['accountName'];
        $this->toHolderName = $toAccountDetails['holderName'];
        $this->toHolderPhoto = $toAccountDetails['holderPhoto'];
        $this->showDropdown = false;
        $this->search = '';
        $this->emit('toAccountSelected', $toAccount);
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
            ->whereHas('accountable', function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orWhere('name', 'like', '%' . $search . '%')
            ->get();
        $mappedAccounts = $accounts->map(function ($account, $key) {
            return [
                'accountId' => $account->id,
                'accountName' => $account->name,
                'holderId' => $account->accountable->id,
                'holderName' => $account->accountable->name,
                'holderPhoto' => url(Storage::url($account->accountable->profile_photo_path))
            ];
        })->whereNotIn('accountId', $excludeAccount);

        $response = $mappedAccounts->take(6);

        $this->searchResults = $response;
    }


    public function render()
    {
        $this->updatedSearch($this->search);
        return view('livewire.to-account');
    }
}
