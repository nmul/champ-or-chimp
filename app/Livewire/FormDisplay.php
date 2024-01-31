<?php

namespace App\Livewire;

use App\Livewire\Entryform;
use Livewire\Component;

class FormDisplay extends Component
{

    public $details;
    public $loopIteration;

    public function mount($details, $loopIteration){
        $this->details = $details;
        $this->loopIteration = $loopIteration;
    }

    public function editEntryForm(String $entryFormId)
    {
        $this->redirectRoute('entryform', ["id" => $entryFormId]);
    }

    public function deleteEntryForm(String $entryFormId)
    {
        $cart = session()->get('cart');
        unset($cart[$entryFormId]);
        session()->put('cart', $cart);
        $this->redirect('cart');
    }

    public function render()
    {
        return view('livewire.form-display');
    }
}
