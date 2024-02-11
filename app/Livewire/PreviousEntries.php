<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PreviousEntries extends Component
{

    public $userEntries;

    public function mount(){
        $user_id = Auth::id();
        $this->userEntries = DB::table('entry')
                            ->where('user_id', $user_id)
                            ->get();
    }

    public function render()
    {
        return view('livewire.previous-entries')->layout('layouts.app');
    }
}
