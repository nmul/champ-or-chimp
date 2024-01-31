<div>
    @if(session('cart'))
        <div class="container grid md:grid-cols-2 mx-auto">
            <div id="order-container">
                @foreach(session('cart') as $id => $details)
                    @livewire(FormDisplay::class, ['details' => $details, 'loopIteration' => $loop->iteration], key($details['id']))
                @endforeach
            </div>
            <div id="checkout-container">
                <h1>This is where the checkout will be</h1>
            </div>
        </div>   
    @else
        <h1>You have nothing in your cart</h1>
    @endif

</div>
