<div>
        <div class="container mt-3 rounded-lg shadow mx-auto h-full flex justify-center" id="entry-form-container">
            <form wire:submit="addToCart" id="entryForm" name="entryForm" method="POST" wire:loading.class="opacity-50">
                @csrf
                
                @if($currentPage == 0)
                <div id="landing-page" class="max-w-md mx-auto">
                    <h1 class="text-5xl font-extrabold mx-auto custom-orange-text text-center" id="first-ef-heading">Champ Or Chimp</h1>
                    <h1 class="text-3xl font-extrabold mx-auto custom-red-text text-center">Entry Form 2024</h1>
                    <h1 class="text-xl text-blue-500 underline text-center my-2"><a href="{{ URL('info') }}">Want to know more?</a></h1>

                    <div class="mb-20 mt-3 p-5 bg-white shadow-md rounded">
                        <p class="text-black block px-2 pb-1 mb-1 font-semibold">If you wish to enter on behalf of someone else, use this section to do so.</p>
                        <div class="flex items-center h-5">
                            <input id="enteringForSomeone" wire:model="enteringForSomeone" type="checkbox" value="" class="w-4 h-4 ml-2 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                            <label for="enteringForSomeone" class="ms-2 text-md font-medium text-gray-900">Are you entering for someone else?</label>    
                        </div>
                        <div id="other-entry-div" class="hidden mt-2">
                            <div class="mb-5">
                                <label for="firstName" class="block mb-2 text-md font-medium text-gray-900">Entrant's First Name</label>
                                <input wire:model="firstName" type="text" id="firstName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="First Name">
                            </div>
                            <div class="mb-5">
                                <label for="lastName" class="block mb-2 text-md font-medium text-gray-900">Entrant's Last Name</label>
                                <input wire:model="lastName" type="text" id="lastName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="Last Name">
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-md font-medium text-gray-900">Entrant's Email</label>
                                <input wire:model="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="Email">
                            </div>
                        </div>
                    </div>

                    


                    <div id="quick-pick-info-container" class="custom-alert-box" role="alert">
                        <img id="winner-chimp" src="{{ URL('/images/winner-chimp.jpg') }}" >
                        <h1 class="text-right custom-red-text font-extrabold text-2xl">Feeling Lucky?</h1>
                        <p class="font-semibold">
                          Select quick pick to have an entry generated for you!
                        </p>
                        <div class="flex items-center h-5 mt-2 mb-2 pb-2">
                            <input id="quick-pick" wire:model="is_quick_pick" type="checkbox" value="" class="w-4 h-4 ml-2 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                            <label for="quick-pick" class="ms-2 text-md font-medium text-gray-900">Quick Pick?</label>
                        </div>
                        <p class="font-semibold">Learn more about Quick Pick Entries <a class="text-blue-500 underline" href="{{ URL('info#quick-pick-question') }}">here!</a></p>
                    </div>

                    

                    <div class="flex flex-col items-center pb-10">
                    <!-- Buttons -->
                        <div class="inline-flex mt-2 xs:mt-0 mb-3">
                            <button type="button" id="landing-page-next-button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900">
                                Proceed to Entry
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                @if($currentPage == 1)
                <div id="irish-competition" class="mx-auto">
                    <h1 class="text-4xl font-extrabold mx-auto mb-3 custom-red-text text-center">Irish Sporting Events</h1>

                    <div class="grid md:grid-cols-2 gap-2">

                        <div id="how-to-input-info-container" class="custom-alert-box" role="alert">
                            <img id="irish-chimp" src="{{ URL('images/irish-chimp.jpg') }}" >

                            <h1 class="custom-red-text font-extrabold text-2xl">First time?</h1>

                            <p>
                                Start typing to see competitors... maybe today is your lucky day!
                            </p>
                        </div>

                        <div id="how-to-input-info-container" class="custom-alert-box" role="alert">
                            <img id="scientist-chimp" src="{{ URL('images/scientist-chimp.jpg') }}" >

                            <h1 class="text-right custom-red-text font-extrabold text-2xl">Clueless?</h1>

                            <p>
                                Leave a field blank to have it selected by our quick pick algorithm!
                            </p>
                        </div>
                    </div>

                    <!-----------------Camogie-------------------->
                    <div class="wrapper mt-3 mx-auto md:flex md:flex-col">
                        <div class="formRow md:ml-56">
                            <label for="camogie" class="block mb-1 text-md font-medium text-gray-900">
                                All Ireland Camogie Championship
                            </label>
                            @if($camogie_answer != '')
                                <div class="flex items-center mx-auto">
                                    <input id="camogie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('camogie')->where('id', $camogie_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('camogie_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'camogie', 'nameCol' => 'name', 'eventId' => 17, 'fieldName' => 'camogie_answer'])
                            @endif
                            <br>
                        </div>
                        <!-----------------Hurling-------------------->
                        <div class="formRow md:ml-56">
                            <label for="hurling" class="block mb-1 text-md font-medium text-gray-900">
                                All Ireland Hurling Championship
                            </label>
                            @if($hurling_answer != '')
                                <div class="flex flex-center">
                                    <input id="hurling" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('hurling')->where('id', $hurling_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('hurling_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'hurling', 'nameCol' => 'name', 'eventId' => 14, 'fieldName' => 'hurling_answer'])
                            @endif
                            <br>
                        </div>
                        <!-----------------Ladies Gaelic Football-------------------->
                        <div class="formRow md:ml-56">
                            <label for="ladiesGaelic" class="block mb-1 text-md font-medium text-gray-900">
                                Ladies Gaelic Football Championship
                            </label>
                            @if($ladies_gaelic_answer != '')
                                <div class="flex flex-center">
                                    <input id="ladiesGaelic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('ladiesgaelic')->where('id', $ladies_gaelic_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('ladies_gaelic_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'ladiesgaelic', 'nameCol' => 'name', 'eventId' => 16, 'fieldName' => 'ladies_gaelic_answer'])
                            @endif
                            <br>
                        </div>
                        <!-----------------All Ireland Gaelic Football-------------------->
                        <div class="formRow md:ml-56">
                            <label for="gaelic" class="block mb-1 text-md font-medium text-gray-900">
                                All Ireland Gaelic Football
                            </label>
                            @if($gaelic_answer != '')
                                <div class="flex flex-center">
                                    <input id="gaelic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('gaelic')->where('id', $gaelic_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('gaelic_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'gaelic', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'gaelic_answer'])
                            @endif
                            <br>
                        </div>

                        <div class="flex flex-col items-center pb-10">
                            <!-- Help text -->
                            <span class="text-sm text-gray-700">
                                Page <span class="font-semibold text-gray-900">{{ $currentPage }}</span> of <span class="font-semibold text-gray-900">{{ $maxPage }}</span>
                            </span>
                            <!-- Buttons -->
                            <div class="inline-flex mt-2 xs:mt-0">
                                <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 custom-back-button">
                                    Prev
                                </button>
                                <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 custom-next-button">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                @if($currentPage == 2)
                <div id="football-and-rugby"  class="max-w-md mx-auto">
                    <h1 class="text-4xl font-extrabold mx-auto mb-3 custom-red-text ml-0">Football and Rugby</h1>
                    <div class="wrapper mt-3 mx-auto md:flex md:flex-col">
                        <!-----------------Champions Cup-------------------->
                        <div class="formRow ">
                            <label for="championsCup" class="block mb-1 text-md font-medium text-gray-900">
                                Rugby Champions Cup
                            </label>
                            @if($champions_cup_answer != '')
                                <div class="flex flex-center">
                                    <input id="championsCup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('championscup')->where('id', $champions_cup_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('champions_cup_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'championscup', 'nameCol' => 'name', 'eventId' => 4, 'fieldName' => 'champions_cup_answer'])
                            @endif
                            <br>
                        </div>

                        <!-----------------Champions League-------------------->
                        <div class="formRow">
                            <label for="championsLeague" class="block mb-1 text-md font-medium text-gray-900">
                                Champions League
                            </label>
                            @if($champions_league_answer != '')
                                <div class="flex flex-center">
                                    <input id="championsLeague" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('championsleague')->where('id', $champions_league_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('champions_league_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'championsleague', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'champions_league_answer'])
                            @endif
                            <br>
                        </div>

                        <h1 class="text-4xl font-extrabold mx-auto mb-3 custom-red-text ml-0">Horse Racing</h1>
                        <!-----------------Champion Hurdle-------------------->
                        <div class="formRow">
                            <label for="championHurdle" class="block mb-1 text-md font-medium text-gray-900">
                                Champion Hurdle
                            </label>
                            @if($champion_hurdle_answer != '')
                                <div class="flex flex-center">
                                    <input id="championHurdle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('championhurdle')->where('id', $champion_hurdle_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('champion_hurdle_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'championhurdle', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'champion_hurdle_answer'])
                            @endif
                            <br>
                        </div>
                        <!-----------------Gold Cup-------------------->
                        <div class="formRow">
                            <label for="goldCup" class="block mb-1 text-md font-medium text-gray-900">
                                Gold Cup
                            </label>
                            @if($gold_cup_answer != '')
                                <div class="flex flex-center">
                                    <input id="goldCup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('goldcup')->where('id', $gold_cup_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('gold_cup_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'goldcup', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'gold_cup_answer'])
                            @endif
                            <br>
                        </div>

                        <h1 class="text-4xl font-extrabold mx-auto mb-3 custom-red-text ml-0">Tennis</h1>
        
                            <!-----------------Wimbledon Ladies -------------------->
                            <div class="formRow">
                                <label for="wimbledonLadies" class="block mb-1 text-md font-medium text-gray-900">
                                    Wimbledon Ladies
                                </label>
                                @if($wimbledon_ladies_answer != '')
                                    <div class="flex flex-center">
                                        <input id="hurling" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('tennisladies')->where('id', $wimbledon_ladies_answer)->first()->name }}" />
                                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('wimbledon_ladies_answer')">Edit</button>
                                    </div>
                                @else
                                    @livewire('autocomplete', ['table' => 'tennisladies', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'wimbledon_ladies_answer'])
                                @endif
                                <br>
                            </div>
        
                            <!-----------------Wimbledon Mens -------------------->
                            <div class="formRow">
                                <label for="wimbledonMens" class="block mb-1 text-md font-medium text-gray-900">
                                    Wimbledon Mens
                                </label>
                                @if($wimbledon_mens_answer != '')
                                    <div class="flex flex-center">
                                        <input id="wimbledonMens" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('tennismen')->where('id', $wimbledon_mens_answer)->first()->name }}" />
                                        <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('wimbledon_mens_answer')">Edit</button>
                                    </div>
                                @else
                                    @livewire('autocomplete', ['table' => 'tennismen', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'wimbledon_mens_answer'])
                                @endif
                                <br>
                            </div>
                        </div>
                    <div class="flex flex-col items-center pb-10">
                        <!-- Help text -->
                        <span class="text-sm text-gray-700">
                            Page <span class="font-semibold text-gray-900">{{ $currentPage }}</span> of <span class="font-semibold text-gray-900">{{ $maxPage }}</span>
                        </span>
                        <!-- Buttons -->
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 custom-back-button">
                                Prev
                            </button>
                            <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 custom-next-button">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
               
                @endif

                    @if($currentPage == 3)
                    <div id="golfers" class="max-w-md mx-auto">
                        <h1 class="text-4xl font-extrabold mx-auto mb-3 custom-red-text text-center">Golfers</h1>

                        <div class="custom-alert-box" role="alert">
                            <img id="golfing-chimp" src="{{ URL('/images/golfing-chimp.jpg') }}" >
                            <h1 class="text-right custom-red-text font-extrabold text-2xl">Know your golf?</h1>
                            <p>
                              Pick 3 golfers to compete for you in the 4 Majors
                            </p>
                        </div>
    
                        <!-----------------Golfer 1 -------------------->
                        <div class="formRow">
                            <label for="golf1" class="block mb-1 text-md font-medium text-gray-900">
                                Golfer 1
                            </label>
                            @if($golf_1_answer != '')
                                <div class="flex flex-center">
                                    <input id="golf1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('golf')->where('id', $golf_1_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('golf_1_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'golf', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'golf_1_answer', 'golf' => true, 'golfAnswers' => $golfAnswers], key($this->now()))
                            @endif
                            <br>
                        </div>
                        <!-----------------Golfer 2 -------------------->
                        <div class="formRow">
                            <label for="golf2" class="block mb-1 text-md font-medium text-gray-900">
                                Golfer 2
                            </label>
                            @if($golf_2_answer != '')
                                <div class="flex flex-row">
                                    <input id="golf2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('golf')->where('id', $golf_2_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('golf_2_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'golf', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'golf_2_answer', 'golf' => true, 'golfAnswers' => $golfAnswers], key($this->now()))
                            @endif
                            <br>
                        </div>
                        <!-----------------Golfer 3 -------------------->
                        <div class="formRow">
                            <label for="golf3" class="block mb-1 text-md font-medium text-gray-900">
                                Golfer 3
                            </label>
                            @if($golf_3_answer != '')
                                <div class="flex flex-row">
                                    <input id="golf3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('golf')->where('id', $golf_3_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('golf_3_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'golf', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'golf_3_answer', 'golf' => true , 'golfAnswers' => $golfAnswers], key($this->now()))
                            @endif
                            <br>
                        </div>
                        <div class="flex flex-col items-center pb-10">
                            <!-- Help text -->
                            <span class="text-sm text-gray-700">
                                Page <span class="font-semibold text-gray-900">{{ $currentPage }}</span> of <span class="font-semibold text-gray-900">{{ $maxPage }}</span>
                            </span>
                            <!-- Buttons -->
                            <div class="inline-flex mt-2 xs:mt-0">
                                <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 custom-back-button">
                                    Prev
                                </button>
                                <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 custom-next-button">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($currentPage == 4)
                    <div id="double-points-section" class="max-w-md mx-auto">
                        <h1 class="text-4xl font-extrabold mx-auto mb-3 custom-red-text text-center">Double Points</h1>


                        <div class="custom-alert-box" role="alert">
                            <img id="cute-chimp" src="{{ URL('/images/cute-chimp.jpg') }}" >
                            <h1 class="text-right custom-red-text font-extrabold text-2xl">Double Down!</h1>
                            <p>
                              Pick your 4 best competitions to be awarded double points!
                            </p>
                        </div>
    
                        <!-------------------  Double Points 1 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints1" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 1
                            </label>
                            @if($double_points_1_answer != '')
                                <div class="flex flex-center">
                                    <input id="doublePoints1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_1_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('double_points_1_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_1_answer', 'doublePoints' => true, 'doublePointsAnswers' => $doublePointsAnswers])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Double Points 2 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints2" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 2
                            </label>
                            @if($double_points_2_answer != '')
                                <div class="flex flex-center">
                                    <input id="doublePoints2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_2_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('double_points_2_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_2_answer', 'doublePoints' => true, 'doublePointsAnswers' => $doublePointsAnswers])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Double Points 3 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints3" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 3
                            </label>
                            @if($double_points_3_answer != '')
                                <div class="flex flex-center">
                                    <input id="doublePoints3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_3_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('double_points_3_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_3_answer', 'doublePoints' => true, 'doublePointsAnswers' => $doublePointsAnswers ])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Double Points 4 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints4" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 4
                            </label>
                            @if($double_points_4_answer != '')
                                <div class="flex flex-center">
                                    <input id="doublePoints3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_4_answer)->first()->name }}" />
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="button" wire:click="setFieldAsNull('double_points_4_answer')">Edit</button>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_4_answer', 'doublePoints' => true, 'doublePointsAnswers' => $doublePointsAnswers])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Tie breaker ----------------------------->
                        <div class="formRow">
                            <label for="tiebreak" class="block mb-1 text-md font-medium text-gray-900">
                                Winning score of US Masters? (e.g. -10)
                            </label>
                                <div class="flex flex-center">
                                    <input wire:model="tiebreak" id="tiebreak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" type="number" step="1" min="-30" max="30" value="0" >
                                </div>
                            <br>
                        </div>
                        <div class="flex flex-col items-center pb-10">
                            <!-- Help text -->
                            <span class="text-sm text-gray-700">
                                Page <span class="font-semibold text-gray-900">{{ $currentPage }}</span> of <span class="font-semibold text-gray-900">{{ $maxPage }}</span>
                            </span>
                            <!-- Buttons -->
                            <div class="inline-flex mt-2 xs:mt-0">
                                <button type="button" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 custom-back-button">
                                    Prev
                                </button>
                                <button type="submit" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900">
                                    Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
            </form>
        </div>
    <hr>

    @script
    <script>

        $(document).ready(function () {
            if ($('#enteringForSomeone').is(":checked")){
                $('#other-entry-div').show();
            } else {
                $('#other-entry-div').hide();
            }

            if ($('#quick-pick').is(":checked")){
                $('#landing-page-next-button').html("Add To Cart");
            } else {
                $('#landing-page-next-button').html("Proceed to Entry");
            }
        });

        $(document).on('click', '#landing-page-next-button', function() {
            if ($('#quick-pick').is(":checked")){
                // work on showing a modal here tomorrow
                $wire.addToCart();
            } else {
                let currPage = $wire.$get('currentPage')
                $wire.$set('currentPage', currPage + 1);
            }
        });

        $(document).on('click', '.custom-next-button', function () {
            let valid = true;
            const autocompleteFields = document.getElementsByClassName('autocomplete-field');
            for (let i = 0; i < autocompleteFields.length; i++){
                if (autocompleteFields[i].value !== ''){
                    $wire.autocompleteNotEmpty();
                    valid = false;
                }
            }
            if (valid){
                let currPage = $wire.$get('currentPage');
                $wire.$set('currentPage', currPage + 1);
            }
        });

        $(document).on('click', '.custom-back-button', function () {
            let currPage = $wire.$get('currentPage');
            $wire.$set('currentPage', currPage - 1);
        });

        $(document).on('change', '#enteringForSomeone', function() {
            $('#other-entry-div').toggle();
        });

        $(document).on('click', '#close-info-box', function() {
            $('#quick-pick-info-container').toggle();
        });

        $(document).on('click', '#toggle-info-button', function() {
            $('#quick-pick-info-container').toggle();
        })

        $(document).on('click', '#close-input-info-box', function() {
            $('#how-to-input-info-container').toggle();
        });

        $(document).on('click', '#close-more-info-box', function() {
            $('#more-info-box').toggle();
        });

        $(document).on('change', '#quick-pick', function() {
            if ($('#quick-pick').is(":checked")){
                $('#landing-page-next-button').html("Add To Cart");
            } else {
                $('#landing-page-next-button').html("Proceed to Entry");
            }
        });
    </script>
    @endscript
</div>

