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
use Illuminate\Support\Facades\Session;
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

    public $enteringForSomeone = false;
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

    public function setFieldAsNull(string $fieldName){
        $this->$fieldName = null;
    }

    public function addToCart(Request $request){
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