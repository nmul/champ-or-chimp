<div>
    
    @if($cart)
        <h1 class="text-center text-2xl font-extrabold">Order details</h1>
        <div class="container max-w-md mx-auto">
            <div id="order-container">

                @foreach($cart as $details)
                    @livewire(FormDisplay::class, ['details' => $details, 'loopIteration' => $loop->iteration, 'total' => count($cart)], key($details->id))
                @endforeach
            </div>
        </div>
        <form action="POST" wire:submit="checkout">
            @csrf
            <button type="submit" class="bg-white text-black">
                Pay
            </button>
       </form>
    @else
        <h1>You have nothing in your cart</h1>
    @endif
</div>
