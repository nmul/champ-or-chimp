<?php

namespace App\Livewire;

use Livewire\Component;

class InfoPage extends Component
{
    public function render()
    {
        return view('livewire.info-page')->layout('layouts.guest');
    }
}
