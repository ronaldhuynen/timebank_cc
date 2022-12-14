<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CreateUserForm extends Component
{
    public $currentPage = 1;
    public $success;

    // Form properties
    public $name;
    public $email;
    public $about;
    public $motivation;
    public $date_of_birth;
    public $locale;
    public $password;
    public $confirmPassword;

    public $pages = [
        1 => [
            'heading' => 'Personal Information',
            'subheading' => 'Enter your name and email to get started.',
        ],
        2 => [
            'heading' => 'Additional info',
            'subheading' => 'Briefly introduce yourself to other users',
        ],
        3 => [
            'heading' => 'Password',
            'subheading' => 'Finally, create a password for your Timebank.cc account.',
        ],
    ];

    private $validationRules = [
        1 => [
            'name' => ['required', 'min:3', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
        ],
        2 => [
            'about' => ['string'],
            'motivation' => ['string'],
            'date_of_birth' => ['date'],
        ],
        3 => [
            'password' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'string', 'same:password', 'min:8'],
        ],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->validationRules[$this->currentPage]);
    }

    public function goToNextPage()
    {
        $this->validate($this->validationRules[$this->currentPage]);
        $this->currentPage++;
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    public function resetSuccess()
    {
        $this->reset('success');
    }

    public function submit()
    {
        $rules = collect($this->validationRules)->collapse()->toArray();

        $this->validate($rules);

        User::create([
            'name' => "{$this->name} {$this->name}",
            'email' => $this->email,
            'about' => $this->about,
            'motivation' => $this->motivation,
            'date_of_birth' => $this->date_of_birth,
            'locale' => 'nl',   //TODO: Find locale by browser language
            'password' => bcrypt($this->password),
        ]);

        $this->reset();
        $this->resetValidation();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.create-user-form');
    }
}
