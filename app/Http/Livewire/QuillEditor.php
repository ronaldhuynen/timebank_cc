<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class QuillEditor extends Component
{    
    #[Rule('required|min:10|string|max:1048576')]  // 1MB in bytes
    public $content;

    public function mount($content)
    {
        $this->content = $content;
    }

    
    public function updatedContent()
    {
        $this->validateOnly('content');
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
