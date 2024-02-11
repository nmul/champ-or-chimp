<div>
    <div class="order-summary-table grid mt-3">

        <h3 class="text-center"> Entry Form Details <i>{{ $loopIteration }}</i> of <i>{{ $total }}</i> </h1>
        <div class="grid grid-cols-2 mx-5 my-1">
           <div>Entrant First Name: </div>
           <div>{{ $details -> firstName}}</div>
           <div>Entrant Last Name: </div>
           <div>{{ $details -> lastName }}</div>
           <div>Entrant Email: </div>
           <div>{{ $details -> email }}</div>
           <div>Is Quick Pick? </div>
           <div>
                @if ($details -> is_quick_pick)
                    <div aria-label="is quick pick"><i class="fa-solid fa-check"></i></div>
                @else
                    <div aria-label="not quick pick"><i class="fa-solid fa-xmark"></i></div>
                @endif
            </div>
            @if(!$details -> is_quick_pick )

                <div>All Ireland Camogie</div>
                <div>{{ $details ->camogie_answer ? DB::table('camogie')->where('id', $details ->camogie_answer )->first()->name  : "Quick Pick" }}</div>


                <div>All Ireland Hurling</div>
                <div>{{ $details ->hurling_answer ? DB::table('hurling')->where('id', $details ->hurling_answer )->first()->name  : "Quick Pick" }}</div>

                
                <div>All Ireland Ladies Football</div>
                <div>{{ $details ->ladies_gaelic_answer ? DB::table('ladies_gaelic')->where('id', $details ->ladies_gaelic_answer )->first()->name  : "Quick Pick" }}</div>

                <div>All Ireland Mens Football</div>
                <div>{{ $details ->gaelic_answer ? DB::table('gaelic')->where('id', $details ->gaelic_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Champions Cup</div>
                <div>{{ $details ->champions_cup_answer ? DB::table('champions_cup')->where('id', $details ->champions_cup_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Champions League</div>
                <div>{{ $details ->champions_league_answer ? DB::table('champions_league')->where('id', $details ->champions_league_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Champion Hurdle</div>
                <div>{{ $details ->champion_hurdle_answer ? DB::table('champion_hurdle')->where('id', $details ->champion_hurdle_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Gold Cup</div>
                <div>{{ $details ->gold_cup_answer ? DB::table('gold_cup')->where('id', $details ->gold_cup_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Wimbledon Ladies</div>
                <div>{{ $details ->wimbledon_ladies_answer ? DB::table('wibmledon_ladies')->where('id', $details->wimbledon_ladies_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Wimbledon Mens</div>
                <div>{{ $details ->wimbledon_mens_answer ? DB::table('wibmledon_mens')->where('id', $details ->wimbledon_mens_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Golfer 1</div>
                <div>{{ $details ->golf_1_answer ? DB::table('golf')->where('id', $details ->golf_1_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Golfer 2</div>
                <div>{{ $details ->golf_2_answer ? DB::table('golf')->where('id', $details ->golf_2_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Golfer 3</div>
                <div>{{ $details ->golf_3_answer ? DB::table('golf')->where('id', $details ->golf_3_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Double Points Event 1</div>
                <div>{{ $details ->double_points_1_answer ? DB::table('event')->where('id', $details ->double_points_1_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Double Points Event 2</div>
                <div>{{ $details ->double_points_2_answer ? DB::table('event')->where('id', $details ->double_points_2_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Double Points Event 3</div>
                <div>{{ $details ->double_points_3_answer ? DB::table('event')->where('id', $details ->double_points_3_answer )->first()->name  : "Quick Pick" }}</div>

                <div>Double Points Event 4</div>
                <div>{{ $details ->double_points_4_answer ? DB::table('event')->where('id', $details ->double_points_4_answer )->first()->name  : "Quick Pick" }}</div>

                <div>US Open Winning Score (Tiebreak)</div>
                <div>{{ $details ->tiebreak }}</div>
                
            @endif

            <div class="col-span-2 flex justify-center mt-2 xs:mt-0">
                <button type="button" wire:click="editEntryForm('{{ $details->id }}')" class="mx-2 px-2 h-10 text-base font-medium border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white">
                    Edit
                </button>
                <button type="button" class="mx-2 px-2 h-10 text-base font-medium border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white" x-on:click="$wire.deleteEntryForm('{{ $details->id }}')" @click="showDeleteModal = true;">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
