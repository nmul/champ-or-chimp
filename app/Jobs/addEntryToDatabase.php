<?php

namespace App\Jobs;

use App\Models\Entry;
use App\Models\Golf;
use App\Models\MissingField;
use App\Models\Prediction;
use App\Models\QuickPick;
use App\Models\User;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class addEntryToDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $cartData;
    private $order_id;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $cartData, $order_id)
    {
        $this->userId = $userId;
        $this->cartData = $cartData;
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->cartData as $id => $details){
            $this->createEntryAndPredictions($this-> userId, $details, $this->order_id);
        }
    }

    function createEntryAndPredictions($userId, $cartItem, $order_id){
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
        $e = new Entry();
        $e -> competition_id = 12;
        $e -> first_name = $cartItem['firstName'];
        $e -> last_name = $cartItem['lastName'];
        $e -> email = $cartItem['email'];

        // check if quick pick here. Perform randomization logic
        // assign golfers 1,2,3 and Double points 1,2,3,4
        $e -> user_id = $userId;
        $selectedGolfers = array();
        $this->addToArrayIfPresent($selectedGolfers, $cartItem['golf_1_answer']);
        $this->addToArrayIfPresent($selectedGolfers, $cartItem['golf_2_answer']);
        $this->addToArrayIfPresent($selectedGolfers, $cartItem['golf_3_answer']);
        $returned_golfers = $this->findGolfers($selectedGolfers);
        $e -> golf_1_id = $returned_golfers[0];
        $e -> golf_2_id = $returned_golfers[1];
        $e -> golf_3_id = $returned_golfers[2];

        // handle double points events
        $events_array = array();
        $this->addToArrayIfPresent($events_array, $cartItem['double_points_1_answer']);
        $this->addToArrayIfPresent($events_array, $cartItem['double_points_2_answer']);
        $this->addToArrayIfPresent($events_array, $cartItem['double_points_3_answer']);
        $this->addToArrayIfPresent($events_array, $cartItem['double_points_4_answer']);
        $new_events_array = $this->generateEventsIfNotSelected($events_array);
        $e -> double_points_1_id = $new_events_array[0];
        $e -> double_points_2_id = $new_events_array[1];
        $e -> double_points_3_id = $new_events_array[2];
        $e -> double_points_4_id = $new_events_array[3];
        if ($cartItem['tiebreak'] == null || $cartItem['tiebreak'] == ''){
            $e -> tiebreak = mt_rand(-20, -5);
        } else {
            $e -> tiebreak = $cartItem['tiebreak'];
        }
        $e -> is_quick_pick = $cartItem['is_quick_pick'];
        $e -> order_id = $this->order_id;
        $completed_entry = Entry::create( $e->toArray() );
        $new_entry_id = $completed_entry -> id;
        $camogie_prediction = new Prediction();
        $camogie_prediction-> entry_id = $new_entry_id;
        $camogie_prediction-> event_id = $camogie_id;
        if (empty($cartItem['camogie_answer'])) {
            MissingField::create($camogie_prediction->toArray());
            // generate answer and insert into prediction table
            $generatedCamogieId = $this->findQuickPick( $camogie_id );
            $camogie_prediction-> selection_id = $generatedCamogieId;
        } else {
            $camogie_prediction-> selection_id = $cartItem['camogie_answer'];
        }
        Prediction::create($camogie_prediction->toArray());
        $champion_hurdle_prediction = new Prediction();
        $champion_hurdle_prediction-> entry_id = $new_entry_id;
        $champion_hurdle_prediction-> event_id = $champion_hurdle_id;
        if (empty($cartItem['champion_hurdle_answer'])) {
            MissingField::create($champion_hurdle_prediction->toArray());
            // generate answer and insert into prediction table
            $selectionId = $this->findQuickPick( $champion_hurdle_id );
            $champion_hurdle_prediction-> selection_id = $selectionId;
        } else {
            $champion_hurdle_prediction-> selection_id = $cartItem['champion_hurdle_answer'];
        }
        Prediction::create($champion_hurdle_prediction->toArray());
        $champions_cup_prediction = new Prediction();
        $champions_cup_prediction-> entry_id = $new_entry_id;
        $champions_cup_prediction-> event_id = $champions_cup_id;
        if (empty($cartItem['champions_cup_answer'])) {
            MissingField::create($champions_cup_prediction->toArray());
            $selectionId = $this->findQuickPick( $champions_cup_id );
            $champions_cup_prediction-> selection_id = $selectionId;
        } else {
            $champions_cup_prediction-> selection_id = $cartItem['champions_cup_answer'];
        }
        Prediction::create($champions_cup_prediction->toArray());

        $champions_league_prediction = new Prediction();
        $champions_league_prediction-> entry_id = $new_entry_id;
        $champions_league_prediction-> event_id = $champions_league_id;
        if (empty($cartItem['champions_league_answer'])) {
            MissingField::create($champions_league_prediction->toArray());
            $selectionId = $this->findQuickPick( $champions_league_id );
            $champions_league_prediction -> selection_id = $selectionId;
        } else {
            $champions_league_prediction-> selection_id = $cartItem['champions_league_answer'];
        }
        Prediction::create($champions_league_prediction->toArray());

        $gaelic_prediction = new Prediction();
        $gaelic_prediction->entry_id = $new_entry_id;
        $gaelic_prediction->event_id = $gaelic_id;
        if (empty($cartItem['gaelic_answer'])) {
            MissingField::create($gaelic_prediction->toArray());
            $selectionId = $this->findQuickPick( $gaelic_id );
            $gaelic_prediction -> selection_id = $selectionId;
        } else {
            $gaelic_prediction->selection_id = $cartItem['gaelic_answer'];
        }
        Prediction::create($gaelic_prediction->toArray());

        $gold_cup_prediction = new Prediction();
        $gold_cup_prediction->entry_id = $new_entry_id;
        $gold_cup_prediction->event_id = $gold_cup_id;
        if (empty($cartItem['gold_cup_answer'])) {
            MissingField::create($gold_cup_prediction->toArray());
            $selectionId = $this->findQuickPick( $gold_cup_id );
            $gold_cup_prediction -> selection_id = $selectionId;
        } else {
            $gold_cup_prediction->selection_id = $cartItem['gold_cup_answer'];
        }
        Prediction::create($gold_cup_prediction->toArray());

        $hurling_prediction = new Prediction();
        $hurling_prediction->entry_id = $new_entry_id;
        $hurling_prediction->event_id = $hurling_id;
        if (empty($cartItem['hurling_answer'])) {
            MissingField::create($hurling_prediction->toArray());
            $selectionId = $this->findQuickPick( $hurling_id );
            $hurling_prediction -> selection_id = $selectionId;
        } else {
            $hurling_prediction->selection_id = $cartItem['hurling_answer'];
        }
        Prediction::create($hurling_prediction->toArray());


        $ladies_gaelic_prediction = new Prediction();
        $ladies_gaelic_prediction->entry_id = $new_entry_id;
        $ladies_gaelic_prediction->event_id = $ladies_gaelic_id;
        if (empty($cartItem['ladies_gaelic_answer'])) {
            MissingField::create($ladies_gaelic_prediction->toArray());
            $selectionId = $this->findQuickPick( $ladies_gaelic_id );
            $ladies_gaelic_prediction -> selection_id = $selectionId;
        } else {
            $ladies_gaelic_prediction->selection_id = $cartItem['ladies_gaelic_answer'];
        }
        Prediction::create($ladies_gaelic_prediction->toArray());

        $wimbledon_ladies_prediction = new Prediction();
        $wimbledon_ladies_prediction->entry_id = $new_entry_id;
        $wimbledon_ladies_prediction->event_id = $wimbledon_ladies_id;
        if (empty($cartItem['wimbledon_ladies_answer'])) {
            MissingField::create($wimbledon_ladies_prediction->toArray());
            $selectionId = $this->findQuickPick( $wimbledon_ladies_id );
            $wimbledon_ladies_prediction -> selection_id = $selectionId;
        } else {
            $wimbledon_ladies_prediction->selection_id = $cartItem['wimbledon_ladies_answer'];
        }
        Prediction::create($wimbledon_ladies_prediction->toArray());

        $wimbledon_mens_prediction = new Prediction();
        $wimbledon_mens_prediction->entry_id = $new_entry_id;
        $wimbledon_mens_prediction->event_id = $wimbledon_mens_id;
        if (empty($cartItem['wimbledon_mens_answer'])) {
            MissingField::create($wimbledon_mens_prediction->toArray());
            $selectionId = $this->findQuickPick( $wimbledon_mens_id );
            $wimbledon_mens_prediction -> selection_id = $selectionId;
        } else {
            $wimbledon_mens_prediction->selection_id = $cartItem['wimbledon_mens_answer'];
        }
        Prediction::create($wimbledon_mens_prediction->toArray());
    }

    function findQuickPick($event_id){
        // generate number 999.99 between 0.00 and 100.
        $randomNumber = rand(1,10000) / 100;
        // get row from quick_pick
        $answer = QuickPick::all()
        ->where('event_id', $event_id)
        ->where('start_value', '<', $randomNumber)
        ->where('end_value', '>=', $randomNumber)
        ->first()
        ->competitor_id;
        if ($answer == null) {
            return 1;
        } else {
            return $answer;
        }
    }

    function findGolfers(array $selectedGolfers){
        if( count($selectedGolfers) == 2 ) {
            $top_10 = true;
        } else {
            $top_10 = false;
        }
        
        while ( count($selectedGolfers) < 3) {
            //generate random number between 0.01 and 100.00 to use in the select query
            $randomNumber1 = rand(1,10000) / 100;
            $randomNumber2 = $randomNumber1;       
            $row = Golf::all()
                        ->where("start_value", '<', $randomNumber1)
                        ->where('end_value', '>=', $randomNumber2)
                        ->first();
            // if this is the 1st Golfer no need to check if it has already been selected
            // just add it to  $selectedGolfers
            if( count($selectedGolfers)== 0){
                array_push($selectedGolfers, $row->id);
                //if selected golfer is top 10
                if( $row->top_10){
                    $top_10 = true;
                }
                continue;    
    
            }else {
                //check if this record has been selected already if so loop to DO
                if( in_array($row->id, $selectedGolfers )){
                    continue;
                }
                // if we have 2 selections already and $top_10 is false and this record is not a top 10 Loop to DO
                if ( count($selectedGolfers) == 2){
                    if (!$top_10 && ! $row->top_10){
                        continue;
                    }
                }       
                //Selected golfer is OK to add
                array_push($selectedGolfers, $row->id);

                if ( $row->top_10 ){
                    $top_10 = true;
                }
            }
        }
        return $selectedGolfers;
    }

    public function addToArrayIfPresent($array, $input){
        if ($input != null && $input != ''){
            array_push($array, $input);
        }
    }

    public function generateEventsIfNotSelected(array $events){
        $competition_id = 12;
        $event_ids = DB::table('events_in_competition')
                     ->where('competition_id', $competition_id)
                     ->pluck('event_id')
                     ->toArray();
        while (count($events) <= 4){
            $random_key = array_rand($event_ids);
            // Access the element at the random key
            $random_event = $event_ids[$random_key];
            if (!in_array($random_event, $events)){
                array_push($events, $random_event);
            }
        }
        return $events;
    }
}
