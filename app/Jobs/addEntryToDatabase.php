<?php

namespace App\Jobs;

use App\Models\Entry;
use App\Models\MissingField;
use App\Models\Prediction;
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

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $cartData)
    {
        $this->userId = $userId;
        $this->cartData = $cartData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->cartData as $id => $details){
            $this->createEntryAndPredictions($this-> userId, $details);
        }
    }

    function createEntryAndPredictions($userId, $cartItem){
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
        $e -> golf_1_id = $cartItem['golf_1_answer'];
        $e -> golf_2_id = $cartItem['golf_2_answer'];
        $e -> golf_3_id = $cartItem['golf_3_answer'];
        $e -> double_points_1_id = $cartItem['double_points_1_answer'];
        $e -> double_points_2_id = $cartItem['double_points_2_answer'];
        $e -> double_points_3_id = $cartItem['double_points_3_answer'];
        $e -> double_points_4_id = $cartItem['double_points_4_answer'];
        $e -> is_quick_pick = $cartItem['is_quick_pick'];
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
        // get row from quick_picks
        $answer = DB::table('quick_picks')
        ->where('event_id', $event_id)
        ->where('start_value', '<', $randomNumber)
        ->where('end_value', '>=', $randomNumber)
        ->first();
        if ($answer == null) {
            return 1;
        } else {
            return $answer;
        }
    }
}
