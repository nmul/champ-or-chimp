<?php

namespace App\Livewire;

use Livewire\Component;

class FormDisplay extends Component
{

    public $details;

    public function mount($details){
        $this->details = $details;
    }

    public function render()
    {
        return view('livewire.form-display');
    }
}
