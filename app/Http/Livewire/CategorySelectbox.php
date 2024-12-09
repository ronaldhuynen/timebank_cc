<?php

namespace App\Http\Livewire;

use App\Models\Category;
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
        $this->categoryOptions = Category::with('translations')
            ->get()
            ->sortBy(function ($category) {
                // Use the translated name (accessor) for sorting 
                return $category->translation->name ?? '';
            })
            ->mapWithKeys(function ($category) {
                return [
                    $category->id => [
                        'category_id' => $category->id,
                        'name' => $category->translation->name ?? __('Untitled category')
                    ]
                ];
            })
            ->toArray();

        $this->categorySelected = $categorySelected;
        $this->updated();
    }


    /**
     * When component is updated
     *
     * @return void
     */
    public function updated()
    {
        $this->dispatch('categorySelected', $this->categorySelected);
    }


    public function render()
    {
        return view('livewire.category-selectbox');
    }
}
