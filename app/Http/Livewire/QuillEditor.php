<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class QuillEditor extends Component
{    
    #[Rule('required|min:10')]
    public $content;

    public function mount($content): void
    {
        // dump($content);
        $this->content = $content;
    }

    public function updated()
    {
        $this->dispatch('quillEditor', $this->content);
    }

    public function render()
    {
        return view('livewire.quill-editor');
    }
}
