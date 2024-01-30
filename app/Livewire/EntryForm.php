<?php

namespace App\Livewire;

use App\Livewire\LOG;
use App\Models\AnswerEvent;
use App\Models\ChampionsLeague;
use App\Models\Competition;
use App\Models\Entry;
use App\Models\Event;
use App\Models\EventsInCompetition;
use App\Models\MissingField;
use App\Models\Prediction;
use App\Models\User;
use App\Models\Camogie;
use App\Models\ChampionHurdle;
use App\Models\ChampionsCup;
use App\Models\Gaelic;
use App\Models\GoldCup;
use App\Models\Golf;
use App\Models\Hurling;
use App\Models\LadiesGaelic;
use App\Models\WibmledonLady;
use App\Models\WibmledonMen;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;

class Entryform extends Component implements Buyable
{
    public $id;
    public $currentPage = 0;
    public $maxPage = 4;

    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $champion_hurdle_answer = '';
    public $gold_cup_answer = '';
    public $champions_cup_answer = '';
    public $champions_league_answer = '';
    public $wimbledon_ladies_answer = '';
    public $wimbledon_mens_answer = '';
    public $hurling_answer = '';
    public $gaelic_answer = '';
    public $ladies_gaelic_answer = '';
    public $camogie_answer = '';
    public $golf_1_answer = '';
    public $golf_2_answer = '';
    public $golf_3_answer = '';
    public $double_points_1_answer = '';
    public $double_points_2_answer = '';
    public $double_points_3_answer = '';
    public $double_points_4_answer = '';
    public $is_quick_pick = false;

    public $formObj;

    #[On('answerEventCreated')]
    public function answerEventCreated($answerEvent){
        $answerId = $answerEvent['answerId'];
        $eventId = $answerEvent['eventId'];
        $fieldName = $answerEvent['fieldName'];
        $this->$fieldName = $answerId;
    }

    public function setFieldAsNull(string $fieldName){
        $this->$fieldName = null;
    }

    public function addToCart(){
        $id = Str::random(30);
        $cart = [];
        $cart[$id] = [
            "id" => $id,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "email" => $this->email,
            "champion_hurdle_answer" => $this->champion_hurdle_answer,
            "gold_cup_answer" => $this->gold_cup_answer,
            "champions_cup_answer" => $this->champions_cup_answer,
            "champions_league_answer" => $this->champions_league_answer,
            "wimbledon_ladies_answer" => $this->wimbledon_ladies_answer,
            "wimbledon_mens_answer" => $this->wimbledon_mens_answer,
            "hurling_answer" => $this->hurling_answer,
            "gaelic_answer" => $this->gaelic_answer,
            "ladies_gaelic_answer" => $this->ladies_gaelic_answer,
            "camogie_answer" => $this->camogie_answer,
            "golf_1_answer" => $this->golf_1_answer,
            "golf_2_answer" => $this->golf_2_answer,
            "golf_3_answer" => $this->golf_3_answer,
            "double_points_1_answer" => $this->double_points_1_answer,
            "double_points_2_answer" => $this->double_points_2_answer,
            "double_points_3_answer" => $this->double_points_3_answer,
            "double_points_4_answer" => $this->double_points_4_answer,
            "is_quick_pick" => $this->is_quick_pick,
        ];
        session()->put('cart', $cart);
        $this->redirect(CartPage::class);  
    }

    public function submit() {        
        // fix later please
        
        $champion_hurdle_id = 1;
        $gold_cup_id = 2;
        $champions_cup_id = 4;
        $champions_league_id = 8;
        $wimbledon_ladies_id = 10;
        $wimbledon_mens_id = 11;
        $hurling_id = 14;
        $gaelic_id = 15;
        $ladies_gaelic_id = 16;
        $camogie_id = 17;

        $user = Auth::user();
        $formFirst = $this->firstName == '' ? $user->first_name : $this->firstName;
        $formLast = $this->lastName == '' ? $user->last_name : $this->lastName;
        $formEmail = $this->email == '' ? $user->email : $this->email;
        $userId = $user->id;
        if ($this->is_quick_pick){
            $user_entry = new Entry();
            $user_entry->user_id = $userId;
            $user_entry-> first_name = $formFirst;
            $user_entry-> last_name = $formLast;
            $user_entry->email = $formEmail;
            $user_entry->is_quick_pick = true;
            $user_entry->competition_id = 12;
            $completed_entry = Entry::create( $user_entry->toArray());
        } else {
            $user_entry = new Entry();
            $user_entry->user_id = $user->id;
            $user_entry->competition_id = 12;
            $user_entry-> first_name = $formFirst;
            $user_entry->last_name = $formLast;
            $user_entry->email = $formEmail;
            // don't seem to be getting the result from the form
            $user_entry->golf_1_id = $this->golf_1_answer;
            $user_entry->golf_2_id = $this->golf_2_answer;
            $user_entry->golf_3_id = $this->golf_3_answer;
            $user_entry->double_points_1_id = $this->double_points_1_answer;
            $user_entry->double_points_2_id = $this->double_points_2_answer;
            $user_entry->double_points_3_id = $this->double_points_3_answer;
            $user_entry->double_points_4_id = $this->double_points_4_answer;
            $user_entry->is_quick_pick = false;
            $completed_entry = Entry::create( $user_entry->toArray() );
            $new_entry_id = $completed_entry->id;

            $camogie_prediction = new Prediction();
            $camogie_prediction-> entry_id = $new_entry_id;
            $camogie_prediction-> event_id = $camogie_id;
            if (empty($this->camogie_answer)) {
                MissingField::create($camogie_prediction->toArray());
            } else {
                $camogie_prediction-> selection_id = $this->camogie_answer;
                Prediction::create($camogie_prediction->toArray());
            }


            $champion_hurdle_prediction = new Prediction();
            $champion_hurdle_prediction-> entry_id = $new_entry_id;
            $champion_hurdle_prediction-> event_id = $champion_hurdle_id;
            if (empty($this->champion_hurdle_answer)) {
                MissingField::create($champion_hurdle_prediction->toArray());
            } else {
                $champion_hurdle_prediction-> selection_id = $this->champion_hurdle_answer;
                Prediction::create($champion_hurdle_prediction->toArray());
            }


            $champions_cup_prediction = new Prediction();
            $champions_cup_prediction-> entry_id = $new_entry_id;
            $champions_cup_prediction-> event_id = $champions_cup_id;
            if (empty($this->champions_cup_answer)) {
                MissingField::create($champions_cup_prediction->toArray());
            } else {
                $champions_cup_prediction-> selection_id = $this->champions_cup_answer;
                Prediction::create($champions_cup_prediction->toArray());
            }

            $champions_league_prediction = new Prediction();
            $champions_league_prediction-> entry_id = $new_entry_id;
            $champions_league_prediction-> event_id = $champions_league_id;
            if (empty($this->champions_league_answer)) {
                MissingField::create($champions_league_prediction->toArray());
            } else {
                $champions_league_prediction-> selection_id = $this->champions_league_answer;
                Prediction::create($champions_league_prediction->toArray());
            }

            $gaelic_prediction = new Prediction();
            $gaelic_prediction->entry_id = $new_entry_id;
            $gaelic_prediction->event_id = $gaelic_id;
            if (empty($this->gaelic_answer)) {
                MissingField::create($gaelic_prediction->toArray());
            } else {
                $gaelic_prediction->selection_id = $this->gaelic_answer;
                Prediction::create($gaelic_prediction->toArray());
            }

            $gold_cup_prediction = new Prediction();
            $gold_cup_prediction->entry_id = $new_entry_id;
            $gold_cup_prediction->event_id = $gold_cup_id;
            if (empty($this-> gold_cup_answer)) {
                MissingField::create($gold_cup_prediction->toArray());
            } else {
                $gold_cup_prediction->selection_id = $this->gold_cup_answer;
                Prediction::create($gold_cup_prediction->toArray());
            }

            $hurling_prediction = new Prediction();
            $hurling_prediction->entry_id = $new_entry_id;
            $hurling_prediction->event_id = $hurling_id;
            if (empty($this->hurling_answer)) {
                MissingField::create($hurling_prediction->toArray());
            } else {
                $hurling_prediction->selection_id = $this->hurling_answer;
                Prediction::create($hurling_prediction->toArray());
            }


            $ladies_gaelic_prediction = new Prediction();
            $ladies_gaelic_prediction->entry_id = $new_entry_id;
            $ladies_gaelic_prediction->event_id = $ladies_gaelic_id;
            if (empty($this->ladies_gaelic_answer)) {
                MissingField::create($ladies_gaelic_prediction->toArray());
            } else {
                $ladies_gaelic_prediction->selection_id = $this->ladies_gaelic_answer;
                Prediction::create($ladies_gaelic_prediction->toArray());
            }

            $wimbledon_ladies_prediction = new Prediction();
            $wimbledon_ladies_prediction->entry_id = $new_entry_id;
            $wimbledon_ladies_prediction->event_id = $wimbledon_ladies_id;
            if (empty($this-> wimbledon_ladies_answer)) {
                MissingField::create($wimbledon_ladies_prediction->toArray());
            } else {
                $wimbledon_ladies_prediction->selection_id = $this-> wimbledon_ladies_answer;
                Prediction::create($wimbledon_ladies_prediction->toArray());
            }

            $wimbledon_mens_prediction = new Prediction();
            $wimbledon_mens_prediction->entry_id = $new_entry_id;
            $wimbledon_mens_prediction->event_id = $wimbledon_mens_id;
            if (empty($this->wimbledon_mens_answer)) {
                MissingField::create($wimbledon_mens_prediction->toArray());
            } else {
                $wimbledon_mens_prediction->selection_id = $this->wimbledon_mens_answer;
                Prediction::create($wimbledon_mens_prediction->toArray());
            }
            // check with Niall if we are creating prediction at this point
        }
    }

    function getBuyableDescription(mixed $options = null){
        return 'champ or chimp form';
    }
    function getBuyableIdentifier(mixed $options = null) {
        $this->id = Str::random(30);
        return $this->id;
    }
    function getBuyablePrice(mixed $options = null){
        return 10;
    }

    public function render()
    {

        
        $competition_id = 12;
        $competition = Competition::find($competition_id);
        $event_ids = DB::table('events_in_competition')
                     ->where('competition_id', $competition_id)
                     ->pluck('event_id')
                     ->toArray();
        $events = DB::table('Event')
                  ->whereIn('id', $event_ids)
                  ->get();


        return view('livewire.entry-form', [
            'competition' => $competition,
            'event_ids'=> $event_ids,
            'events' => $events,
        ])->layout('layouts.app');
    }
}