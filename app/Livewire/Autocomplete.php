<?php

namespace App\Livewire;

use App\Models\AnswerEvent;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Autocomplete extends Component
{
    public $query, $table, $nameCol, $eventId, $fieldName, $results = array(), $entryForm;


    public function updatedQuery(){
        if ($this->query != ''){
            $this->results = DB::table($this->table)->where($this->nameCol, 'like', '%'.$this->query.'%')->limit(6)->get();
        } else {
            $this->results = [];
        }
    }

    public function inputSelected($answerId, $eventId, $fieldName){
        $answerEvent = new AnswerEvent();
        $answerEvent->answerId = $answerId;
        $answerEvent->eventId = $eventId;
        $answerEvent->fieldName = $fieldName;
        $this->dispatch('answerEventCreated', answerEvent: $answerEvent); 
    }

    public function render()
    {
        return view('livewire.autocomplete');
    }
}
