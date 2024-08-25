<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SelectAccount extends Component
{
    public $search;
    public $searchResults = [];
    public $showDropdown = false;
    public $excludeAccountId;
    public $accountId;
    public $accountName;
    public $holderName;
    public $holderPhoto;
    public $userAccounts;
    public $label;

    protected $listeners = ['excludeAccountId', 'resetForm'];

    public function mount($holderName = null)
    {
        if ($holderName) {
            $this->showDropdown = true;
            $this->updatedSearch($holderName);
            $this->search = $holderName;
        }
    }

    public function checkValidation()
    {
        $this->dispatch('accountValidation');
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function updatedSelected()
    {
        $this->dispatch('selected', $this->selected)->self();
    }

    public function excludeAccountId($excludeAccount)
    {
        $this->excludeAccountId = $excludeAccount;
    }

    public function holderName($holderName)
    {
        $this->updatedSearch($holderName);
    }

    public function selected($account)
    {
        $this->accountId = $account;
        $accountDetails = collect($this->searchResults)
            ->where('accountId', '=', $account)
            ->first();
        // $this->dispatch('accountDetails', $accountDetails);
        $this->accountName = $accountDetails['accountName'];
        $this->holderName = $accountDetails['holderName'];
        $this->holderPhoto = $accountDetails['holderPhoto'];
        $this->showDropdown = false;
        $this->search = '';
        $this->dispatch('accountSelected', $account);
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
    $excludeAccount = $this->excludeAccountId;
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

    public function render()
    {
        $this->updatedSearch($this->search);
        return view('livewire.select-account');
    }
}
