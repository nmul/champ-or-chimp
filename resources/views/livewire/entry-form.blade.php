<div>

        

        <div class="container mt-5 bg-white-500 border border-gray-200 rounded-lg shadow mx-auto" id="entry-form-container">
            <form wire:submit="submit" id="entryForm" name="entryForm" class="">
                @csrf
                
                @if($currentPage == 0)
                <div id="landing-page" class="max-w-sm mx-auto">
                    <h1 class="text-4xl font-extrabold mx-auto">Champ Or Chimp Entry Form</h1>
                    <div class="flex items-start mb-3 mt-3">
                        <div class="flex items-center h-5">
                            <input id="enter-for-other" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                        </div>
                        <label for="enter-for-other" class="ms-2 text-sm font-medium text-gray-900">Are you entering for someone else?</label>
                    </div>

                    <div id="other-entry-div" class="hidden">
                        <div class="mb-5">
                            <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900">Entrant's First Name</label>
                            <input wire:model="firstName" type="text" id="firstName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="First Name">
                        </div>
                        <div class="mb-5">
                            <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900">Entrant's Last Name</label>
                            <input wire:model="lastName" type="text" id="lastName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="Last Name">
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Entrant's Email</label>
                            <input wire:model="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="Email">
                        </div>
                    </div>

                    <!-- Quick pick explanation goes here -->
                    <div class="flex items-start mb-5">
                        <div class="flex items-center h-5">
                            <input id="quick-pick" wire:model="is_quick_pick" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300">
                        </div>
                        <label for="quick-pick" class="ms-2 text-sm font-medium text-gray-900">Quick Pick?</label>
                        <button id="toggle-info-button" type="button">
                            <svg class="flex-shrink-0 w-4 h-4 me-2 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                        </button>
                        <span class="sr-only">Info</span>
                        <!-- Quick pick icon && also add a quick pick number field which displays after quick pick is selected-->
                    </div>
                    <div id="quick-pick-info-container" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
                        <div class="flex items-center">
                          <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                          </svg>
                          <span class="sr-only">Info</span>
                          <h3 class="text-lg font-medium">Quick Pick Information</h3>
                          <button type="button" id="close-info-box" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#quick-pick-info-container" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                        </div>
                        <div class="mt-2 mb-4 text-sm">
                          A quick pick entry selects all the entries for the competitions for you automatically! A competitor will be chosen for you at random from the list of favourites close to the competition start date.
                        </div>
                    </div>

                    <div id="events-in-competition mt-10">
                        <h1 class="text-lg font-medium">Below are the events for the 2024 competition:</h1>
                        <div>
                            @foreach ($events as $event)
                                <div wire:key="{{ $event->id }}" class="event-table-row"> 
                                    <p>{{ $event->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex rounded-md justify-between" role="group">
                        <button type="button" id="landing-page-cancel-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                          Cancel
                        </button>
                        <button type="button" id="landing-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                          Next
                        </button>
                    </div>
                </div>
                @endif

                @if($currentPage == 1)
                <div id="irish-competition" class="max-w-sm mx-auto">
                    <h1 class="text-4xl font-extrabold mx-auto mb-3">Irish Sporting Events</h1>

                    <div id="how-to-input-info-container" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
                        <div class="flex items-center">
                          <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                          </svg>
                          <span class="sr-only">Info</span>
                          <h3 class="text-lg font-medium">Filling out entry form</h3>
                          <button type="button" id="close-input-info-box" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                        </div>
                        <div class="mt-2 mb-4 text-sm">
                            To fill out the form, start typing in the input box and select your desired option from the list. If you wish to change your selection, click the edit button on the right hand side of the input field.
                        </div>
                    </div>

                    <div id="more-info-box" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                          Don't know anything about a particular competition? Leave a field empty to have it selected by our quick pick algorithm!
                        </div>
                        <button type="button" id="close-more-info-box" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-4" aria-label="Close">
                          <span class="sr-only">Close</span>
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                        </button>
                    </div>

                    <!-----------------Camogie-------------------->
                    <div class="formRow">
                        <label for="camogie" class="block mb-1 text-md font-medium text-gray-900">
                            All Ireland Camogie Championship
                        </label>
                        @if($camogie_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="camogie" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('camogie')->where('id', $camogie_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('camogie_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'camogie', 'nameCol' => 'name', 'eventId' => 17, 'fieldName' => 'camogie_answer'])
                        @endif
                        <br>
                    </div>
                    <!-----------------Hurling-------------------->
                    <div class="formRow">
                        <label for="hurling" class="block mb-1 text-md font-medium text-gray-900">
                            All Ireland Hurling Championship
                        </label>
                        @if($hurling_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="hurling" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('hurling')->where('id', $hurling_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('hurling_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'hurling', 'nameCol' => 'name', 'eventId' => 14, 'fieldName' => 'hurling_answer'])
                        @endif
                        <br>
                    </div>
                    <!-----------------Ladies Gaelic Football-------------------->
                    <div class="formRow">
                        <label for="ladiesGaelic" class="block mb-1 text-md font-medium text-gray-900">
                            Ladies Gaelic Football Championship
                        </label>
                        @if($ladies_gaelic_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="ladiesGaelic" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('ladies_gaelic')->where('id', $ladies_gaelic_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('ladies_gaelic_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'ladies_gaelic', 'nameCol' => 'name', 'eventId' => 16, 'fieldName' => 'ladies_gaelic_answer'])
                        @endif
                        <br>
                    </div>
                    <!-----------------All Ireland Gaelic Football-------------------->
                    <div class="formRow">
                        <label for="gaelic" class="block mb-1 text-md font-medium text-gray-900">
                            All Ireland Gaelic Football
                        </label>
                        @if($gaelic_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="gaelic" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('gaelic')->where('id', $gaelic_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('gaelic_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'gaelic', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'gaelic_answer'])
                        @endif
                        <br>
                    </div>

                    <div class="flex rounded-md justify-between" role="group">
                        <button type="button" id="irish-sport-page-back-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-back-button">
                          Back
                        </button>
                        <button type="button" id="irish-sport-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-next-button">
                          Next
                        </button>
                    </div>


                </div>
                @endif

                @if($currentPage == 2)
                <div id="football-and-rugby"  class="max-w-sm mx-auto">
                    <h1 class="text-4xl font-extrabold mx-auto mb-3">Football and Rugby</h1>

                    <!-----------------Champions Cup-------------------->
                    <div class="formRow">
                        <label for="championsCup" class="block mb-1 text-md font-medium text-gray-900">
                            Rugby Champions Cup
                        </label>
                        @if($champions_cup_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="championsCup" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('champions_cup')->where('id', $champions_cup_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('champions_cup_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'champions_cup', 'nameCol' => 'name', 'eventId' => 4, 'fieldName' => 'champions_cup_answer'])
                        @endif
                        <br>
                    </div>

                    <!-----------------Champions League-------------------->
                    <div class="formRow">
                        <label for="championsLeague" class="block mb-1 text-md font-medium text-gray-900">
                            Champions League
                        </label>
                        @if($champions_league_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="championsLeague" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('champions_league')->where('id', $champions_league_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('champions_league_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'champions_league', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'champions_league_answer'])
                        @endif
                        <br>
                    </div>
                    <div class="flex rounded-md justify-between" role="group">
                        <button type="button" id="irish-sport-page-back-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-back-button">
                          Back
                        </button>
                        <button type="button" id="irish-sport-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-next-button">
                          Next
                        </button>
                    </div>
                </div>
               
                @endif

                @if($currentPage == 3)
                <div id="horse-racing" class="max-w-sm mx-auto">
                    <h1 class="text-4xl font-extrabold mx-auto mb-3">Horse Racing </h1>

                    <!-----------------Champion Hurdle-------------------->
                    <div class="formRow">
                        <label for="championHurdle" class="block mb-1 text-md font-medium text-gray-900">
                            Champion Hurdle
                        </label>
                        @if($champion_hurdle_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="championHurdle" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('champion_hurdle')->where('id', $champion_hurdle_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('champion_hurdle_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'champion_hurdle', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'champion_hurdle_answer'])
                        @endif
                        <br>
                    </div>
                    <!-----------------Gold Cup-------------------->
                    <div class="formRow">
                        <label for="goldCup" class="block mb-1 text-md font-medium text-gray-900">
                            Gold Cup
                        </label>
                        @if($gold_cup_answer != '')
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input id="goldCup" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('gold_cup')->where('id', $gold_cup_answer)->first()->name }}" />
                                <div class="absolute inset-y-0 right-16 flex items-center">
                                    <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('gold_cup_answer')">Edit</button>
                                </div>
                            </div>
                        @else
                            @livewire('autocomplete', ['table' => 'gold_cup', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'gold_cup_answer'])
                        @endif
                        <br>
                    </div>
                    <div class="flex rounded-md justify-between" role="group">
                        <button type="button" id="irish-sport-page-back-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-back-button">
                          Back
                        </button>
                        <button type="button" id="irish-sport-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-next-button">
                          Next
                        </button>
                    </div>
                </div>    
                @endif

                    @if($currentPage == 4)
                    <div id="tennis" class="max-w-sm mx-auto">
                        <h1 class="text-4xl font-extrabold mx-auto mb-3">Tennis</h1>
    
                        <!-----------------Wimbledon Ladies -------------------->
                        <div class="formRow">
                            <label for="wimbledonLadies" class="block mb-1 text-md font-medium text-gray-900">
                                Wimbledon Ladies
                            </label>
                            @if($wimbledon_ladies_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="wimbledonLadies" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('wibmledon_ladies')->where('id', $wimbledon_ladies_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('wimbledon_ladies_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'wibmledon_ladies', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'wimbledon_ladies_answer'])
                            @endif
                            <br>
                        </div>
    
                        <!-----------------Wimbledon Mens -------------------->
                        <div class="formRow">
                            <label for="wimbledonMens" class="block mb-1 text-md font-medium text-gray-900">
                                Wimbledon Mens
                            </label>
                            @if($wimbledon_mens_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="wimbledonMens" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('wibmledon_mens')->where('id', $wimbledon_mens_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('wimbledon_mens_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'wibmledon_mens', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'wimbledon_mens_answer'])
                            @endif
                            <br>
                        </div>
                        <div class="flex rounded-md justify-between" role="group">
                            <button type="button" id="irish-sport-page-back-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-back-button">
                              Back
                            </button>
                            <button type="button" id="irish-sport-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-next-button">
                              Next
                            </button>
                        </div>
                    </div>
                    @endif

                    @if($currentPage == 5)
                    <div id="golfers" class="max-w-sm mx-auto">
                        <h1 class="text-4xl font-extrabold mx-auto mb-3">Golfers</h1>
    
                        <!-----------------Golfer 1 -------------------->
                        <div class="formRow">
                            <label for="golf1" class="block mb-1 text-md font-medium text-gray-900">
                                Golfer 1
                            </label>
                            @if($golf_1_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="golf1" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('golf')->where('id', $golf_1_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('golf_1_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'golf', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'golf_1_answer'])
                            @endif
                            <br>
                        </div>
                        <!-----------------Golfer 2 -------------------->
                        <div class="formRow">
                            <label for="golf2" class="block mb-1 text-md font-medium text-gray-900">
                                Golfer 2
                            </label>
                            @if($golf_2_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="golf2" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('golf')->where('id', $golf_2_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('golf_2_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'golf', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'golf_2_answer'])
                            @endif
                            <br>
                        </div>
                        <!-----------------Golfer 3 -------------------->
                        <div class="formRow">
                            <label for="golf3" class="block mb-1 text-md font-medium text-gray-900">
                                Golfer 3
                            </label>
                            @if($golf_3_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="golf3" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('golf')->where('id', $golf_3_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('golf_3_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'golf', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'golf_3_answer'])
                            @endif
                            <br>
                        </div>
                        <div class="flex rounded-md justify-between" role="group">
                            <button type="button" id="irish-sport-page-back-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-back-button">
                              Back
                            </button>
                            <button type="button" id="irish-sport-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-next-button">
                              Next
                            </button>
                        </div>
                    </div>
                    @endif

                    @if($currentPage == 6)
                    <div id="double-points-section" class="max-w-sm mx-auto">
                        <h1 class="text-4xl font-extrabold mx-auto mb-3">Double Points</h1>
    
                        <!-------------------  Double Points 1 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints1" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 1
                            </label>
                            @if($double_points_1_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="doublePoints1" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_1_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('double_points_1_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_1_answer'])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Double Points 2 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints2" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 2
                            </label>
                            @if($double_points_2_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="doublePoints2" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_2_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('double_points_2_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_2_answer'])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Double Points 3 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints3" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 3
                            </label>
                            @if($double_points_3_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="doublePoints3" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_3_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('double_points_1_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_3_answer'])
                            @endif
                            <br>
                        </div>
                        <!-------------------  Double Points 4 ----------------------------->
                        <div class="formRow">
                            <label for="doublePoints4" class="block mb-1 text-md font-medium text-gray-900">
                                Double Points 4
                            </label>
                            @if($double_points_4_answer != '')
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input id="doublePoints4" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" aria-readonly="true" readonly value="{{ DB::table('event')->where('id', $double_points_4_answer)->first()->name }}" />
                                    <div class="absolute inset-y-0 right-16 flex items-center">
                                        <button type="button" class="mr-3 text-black" wire:click="setFieldAsNull('double_points_4_answer')">Edit</button>
                                    </div>
                                </div>
                            @else
                                @livewire('autocomplete', ['table' => 'event', 'nameCol' => 'name', 'eventId' => 15, 'fieldName' => 'double_points_4_answer'])
                            @endif
                            <br>
                        </div>
                        <div class="flex rounded-md justify-between" role="group">
                            <button type="button" id="irish-sport-page-back-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-back-button">
                              Back
                            </button>
                            <button type="submit" id="irish-sport-page-next-button" class="px-6 py-2 text-md font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white custom-next-button">
                              Submit
                            </button>
                        </div>
                    </div>
                    @endif
            </form>
        </div>

        

    <hr>

    @script
    <script>

        $(document).ready(function () {
           

        });

        $(document).on('click', '#landing-page-next-button', function() {
            if ($('#quick-pick').is(":checked")){
                $wire.submit();
            } else {
                let currPage = @this.get('currentPage');
                @this.set('currentPage', currPage + 1);
            }
        });

        $(document).on('click', '.custom-next-button', function () {
            let currPage = @this.get('currentPage');
            @this.set('currentPage', currPage + 1);
        });

        $(document).on('click', '.custom-back-button', function () {
            let currPage = @this.get('currentPage');
            @this.set('currentPage', currPage - 1);
        });

        $(document).on('change', '#enter-for-other', function() {
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

    </script>
    @endscript
</div>

