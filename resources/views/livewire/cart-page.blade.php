<div>
    <h1>Cart page baby</h1>

    <h1> {{ count((array) session('cart')) }} </h1>

    @if(session('cart'))

        <h1> cart is here </h1>

        @foreach(session('cart') as $id => $details)
            @livewire(FormDisplay::class, ['details' => $details], key($details['id']))

            <h1>inside the loop</h1>
            <h1>{{ $details['firstName'] }}</h1>
            <h1>{{ $details['lastName'] }}</h1>
            <h1>{{ DB::table('wibmledon_mens')->where('id', $details['wimbledon_mens_answer'])->value('name') }}</h1>

        @endforeach    
    @else
        <h1>You have nothing in your cart</h1>
    @endif

</div>
