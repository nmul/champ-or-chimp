<?php

namespace App\Livewire;

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
use App\Models\Cart;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;

class Entryform extends Component implements Buyable
{
    public $id;
    public $currentPage = 0;
    public $maxPage = 4;

    public $enteringForSomeone = false;

    #[Validate('nullable|min:3', onUpdate: false)]
    public $firstName = '';
    #[Validate('nullable|min:3', onUpdate: false)]
    public $lastName = '';
    #[Validate('nullable|email', onUpdate: false)]
    public $email = '';

    #[Validate('nullable|exists:championhurdle,id', onUpdate: false)]
    public $champion_hurdle_answer = '';
    #[Validate('nullable|exists:goldcup,id', onUpdate: false)]
    public $gold_cup_answer = '';
    #[Validate('nullable|exists:championscup,id', onUpdate: false)]
    public $champions_cup_answer = '';
    #[Validate('nullable|exists:championsleague,id', onUpdate: false)]
    public $champions_league_answer = '';
    #[Validate('nullable|exists:tennisladies,id', onUpdate: false)]
    public $wimbledon_ladies_answer = '';
    #[Validate('nullable|exists:tennismen,id', onUpdate: false)]
    public $wimbledon_mens_answer = '';
    #[Validate('nullable|exists:hurling,id', onUpdate: false)]
    public $hurling_answer = '';
    #[Validate('nullable|exists:gaelic,id', onUpdate: false)]
    public $gaelic_answer = '';
    #[Validate('nullable|exists:ladiesgaelic,id', onUpdate: false)]
    public $ladies_gaelic_answer = '';
    #[Validate('nullable|exists:camogie,id', onUpdate: false)]
    public $camogie_answer = '';
    #[Validate('nullable|exists:golf,id', onUpdate: false)]
    public $golf_1_answer = '';
    #[Validate('nullable|exists:golf,id', onUpdate: false)]
    public $golf_2_answer = '';
    #[Validate('nullable|exists:golf,id', onUpdate: false)]
    public $golf_3_answer = '';
    #[Validate('nullable|exists:event,id', onUpdate: false)]
    public $double_points_1_answer = '';
    #[Validate('nullable|exists:event,id', onUpdate: false)]
    public $double_points_2_answer = '';
    #[Validate('nullable|exists:event,id', onUpdate: false)]
    public $double_points_3_answer = '';
    #[Validate('nullable|exists:event,id', onUpdate: false)]
    public $double_points_4_answer = '';

    public $golfAnswers = [];
    public $doublePointsAnswers = [];
    public $is_quick_pick = false;
    

    public function mount($id = null){
        $token = Session::get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        $cartItems = Cart::getCartItemsAsArrayFromToken($cart);
        if (isset($id) && $cartItems != null && $cartItems[$id] != null){
            $cartForm = $cartItems[$id];
            $this->id = $id;
            $this->enteringForSomeone = $cartForm['enteringForSomeone'];
            $this->firstName = $cartForm['firstName'];
            $this->lastName = $cartForm['lastName'];
            $this->email = $cartForm['email'];
            $this->champion_hurdle_answer = $cartForm['champion_hurdle_answer'];
            $this->gold_cup_answer = $cartForm['gold_cup_answer'];
            $this->champions_cup_answer = $cartForm['champions_cup_answer'];
            $this->champions_league_answer = $cartForm['champions_league_answer'];
            $this->wimbledon_ladies_answer = $cartForm['wimbledon_ladies_answer'];
            $this->wimbledon_mens_answer = $cartForm['wimbledon_mens_answer'];
            $this->hurling_answer = $cartForm['hurling_answer'];
            $this->camogie_answer = $cartForm['camogie_answer'];
            $this->gaelic_answer = $cartForm['gaelic_answer'];
            $this->ladies_gaelic_answer = $cartForm['ladies_gaelic_answer'];
            $this->golf_1_answer = $cartForm['golf_1_answer'];
            $this->golf_2_answer = $cartForm['golf_2_answer'];
            $this->golf_3_answer = $cartForm['golf_3_answer'];
            $this->double_points_1_answer = $cartForm['double_points_1_answer'];
            $this->double_points_2_answer = $cartForm['double_points_2_answer'];
            $this->double_points_3_answer = $cartForm['double_points_3_answer'];
            $this->double_points_4_answer = $cartForm['double_points_4_answer'];
            $this->is_quick_pick = $cartForm['is_quick_pick'];
        } else {
            $this->entryForm = new EntryForm();
        }
    }

    #[On('answerEventCreated')]
    public function answerEventCreated($answerEvent){
        $answerId = $answerEvent['answerId'];
        $eventId = $answerEvent['eventId'];
        $fieldName = $answerEvent['fieldName'];
        $this->$fieldName = $answerId;
    }

    #[On('golfersUpdated')]
    public function dispatchGolfersUpdated($answerId){
        $newGolfers = [];
        array_push($newGolfers, $this->golf_1_answer);
        array_push($newGolfers, $this->golf_2_answer);
        array_push($newGolfers, $this->golf_3_answer);

        $this->golfAnswers = $newGolfers;
    }

    #[On('doublePointsUpdated')]
    public function dispatchDoublePointsUpdated($eventId){
        $newDoublePoints = [];
        array_push($newDoublePoints, $this->double_points_1_answer);
        array_push($newDoublePoints, $this->double_points_2_answer);
        array_push($newDoublePoints, $this->double_points_3_answer);
        array_push($newDoublePoints, $this->double_points_3_answer);
        $this->doublePointsAnswers = $newDoublePoints;
    }

    public function setFieldAsNull(string $fieldName){
        $this->$fieldName = null;
    }

    public function addToCart(Request $request){
        $validated = $this->validate();

        $user = Auth::user();
        $formFirst = $this->firstName == '' ? $user->first_name : $this->firstName;
        $formLast = $this->lastName == '' ? $user->last_name : $this->lastName;
        $formEmail = $this->email == '' ? $user->email : $this->email;
        if (empty($this-> id)){
            $this->id = Str::random(30);
        }
        // check for the session token

        $token = $request->session()->get('cart_token');
        if (!$token){
            $token = Str::uuid()->toString();
            $request->session()->put('cart_token', $token);
        }
        $cart = Cart::where('unique_identifier', $token)->first();
        $cartItems = [];
        $cart_is_present = true;
        if (is_null($cart)) {
            $cart = new Cart();
            $cart_is_present = false;
        }        
        if ($cart_is_present){
            $decrypt = Crypt::decrypt($cart->data, true);
            $allEncodedData = json_decode($decrypt);
            $cartItemsData = (array)$allEncodedData;
            foreach ($cartItemsData as $cartItem){
                $cartItems[$cartItem -> id] = (array)$cartItem;
            }
        }

        $newItem = [
            "id" => $this->id,
            "enteringForSomeone" => $this->enteringForSomeone,
            "firstName" => $formFirst,
            "lastName" => $formLast,
            "email" => $formEmail,
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
            "is_quick_pick" => $this->is_quick_pick
        ];

        $cartItems[$this->id] =  $newItem;

        // recode the items
        $cart->data = $cartItems;
        $cart_as_json = json_encode($cart->data);
        $encrypted_cart = Crypt::encrypt($cart_as_json);
        $number_of_forms = count($cartItems);
        $current_cost = Entry::calculate_price($number_of_forms);
        $cart = Cart::updateOrCreate(
            ['unique_identifier' => $token],
            [
                'data' => $encrypted_cart,
                'user_id' => Auth::id(),
                'number_of_forms' => $number_of_forms,
                'current_cost' => $current_cost,
            ]
        );
        $this->redirect(CartPage::class);  
    }

    function getBuyableDescription(mixed $options = null){
        return 'champ or chimp form';
    }
    function getBuyableIdentifier(mixed $options = null) {
        return $this->id;
    }
    function getBuyablePrice(mixed $options = null){
        return 10;
    }

    public function autocompleteNotEmpty(){
        $this->dispatch('validateAutoComplete');
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

        $golfAnswers = array(); 
        $doublePointsAnswers = array();
        
        
        return view('livewire.entry-form', [
            'competition' => $competition,
            'event_ids'=> $event_ids,
            'events' => $events,
            'doublePointsAnswers' => $doublePointsAnswers,
            'golfAnswers' => $golfAnswers,
        ])->layout('layouts.app');
    }

    public function now(){
        return (string)time();
    }

    public function addToArrayIfPresent($array, $input){
        if ($input != null && $input != ''){
            array_push($array, $input);
        }
    }
}