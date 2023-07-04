<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CategorySelectbox extends Component
{
    public $categoryOptions = [];
    public $categorySelected;

    /**  
     * Prepare the component.
     *
     * @return void
     */
    public function mount($categorySelected)
    {
        $this->categoryOptions = DB::table('category_translations')->where('locale', App::getLocale())->get(['id','category_id','name']);
        $this->categorySelected = $categorySelected;
    }

    /**
     * When component is updated
     *
     * @return void
     */
    public function updated()
    {
        $this->emit('categoryToParent', $this->categorySelected);
    }


    public function render()
    {
        return view('livewire.category-selectbox');
    }
}
