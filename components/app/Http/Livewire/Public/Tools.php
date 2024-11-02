<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;

class Tools extends Component
{
    public $tool_name;
    
    public function render()
    {
        return view('livewire.public.tools');
    }
}
