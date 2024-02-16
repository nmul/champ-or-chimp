<?php

namespace App\Livewire;

use App\Models\AnswerEvent;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Autocomplete extends Component
{
    public $query, $table, $nameCol, $eventId, $fieldName, $results = array(), $entryForm, $doublePoints, $golf, $fieldToFocus;

    #[Reactive]
    public $golfAnswers;
    #[Reactive]
    public $doublePointsAnswers;

    public $focusThisField = false;

    public function mount(){
        if ($this-> fieldToFocus == $this-> fieldName){
            $this-> focusThisField = true;
        }
    }

    #[On('validateAutoComplete')]
    public function checkField(){
        $validated = $this->validate([ 
            'query' => 'prohibited',
        ]);
    }

    #[Computed]
    public function events()
    {
        $event_ids = DB::table('events_in_competition')
        ->where('competition_id', 12)
        ->pluck('event_id')
        ->toArray();
        return $event_ids;
    }

    public function updatedQuery(){
        if ($this->query != ''){
            $event_ids = $this->events();
            if ($this-> doublePoints){
                if ($this->doublePointsAnswers){
                    $this-> results = DB::table($this->table)->whereNotIn('id', $this->doublePointsAnswers)->where($this->nameCol, 'like', '%'.$this->query.'%')->whereIn('id', $event_ids)->limit(6)->get();
                } else {
                    $this-> results = DB::table($this->table)->where($this->nameCol, 'like', '%'.$this->query.'%')->whereIn('id', $event_ids)->limit(6)->get();
                }
            } else if ($this -> golf){
                Log::info($this->golfAnswers);
                if ($this->golfAnswers){
                    $this->results = DB::table($this->table)->where($this->nameCol, 'like', '%'.$this->query.'%')->whereNotIn('id', $this->golfAnswers)->limit(6)->get();
                } else {
                    $this->results = DB::table($this->table)->where($this->nameCol, 'like', '%'.$this->query.'%')->limit(6)->get();
                }
            } else {
                $this->results = DB::table($this->table)->where($this->nameCol, 'like', '%'.$this->query.'%')->limit(6)->get();
            }
            
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
        if ($this->golf){
            $this->dispatch('golfersUpdated', answerId : $answerId);
        }
        if ($this-> doublePoints){
            $this->dispatch('doublePointsUpdated', eventId: $answerId);
        }
    }

    public function render()
    {
        return view('livewire.autocomplete');
    }
}
