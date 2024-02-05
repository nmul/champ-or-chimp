<div>
    
    @if($cart)
        <h1 class="text-center text-2xl font-extrabold">Order details</h1>
        <div class="container max-w-md mx-auto">
            <div id="order-container">

                @foreach($cart as $details)
                    @livewire(FormDisplay::class, ['details' => $details, 'loopIteration' => $loop->iteration, 'total' => count($cart)], key($details->id))
                @endforeach
            </div>
            <form action="POST" wire:submit="checkout">
                @csrf
                <div class="col-span-2 flex justify-center mt-2">
                    <button type="submit" class="mx-3 px-4 h-10 text-base font-medium text-white bg-blue-800 rounded-s hover:bg-gray-900">
                        Checkout
                    </button>
                </div>
                
           </form>
        </div>
       
    @else
        <h1>You have nothing in your cart</h1>
    @endif
</div>
