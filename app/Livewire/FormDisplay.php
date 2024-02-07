<?php

namespace App\Livewire;

use App\Livewire\Entryform;
use App\Models\Cart;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Livewire\Component;

class FormDisplay extends Component
{

    public $details;
    public $loopIteration;
    public $total;

    public function mount($details, $loopIteration, $total){
        $this->details = $details;
        $this->loopIteration = $loopIteration;
        $this->total = $total;
    }

    public function editEntryForm(String $entryFormId)
    {
        $this->redirectRoute('entryform', ["id" => $entryFormId]);
    }

    public function deleteEntryForm(String $entryFormId, Request $request)
    {
        $this->dispatch('deleteEntry', $entryFormId);
    }

    public function render()
    {
        return view('livewire.form-display');
    }
}
