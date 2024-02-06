<div>
    
    @if($cart)
        <h1 class="text-center text-2xl font-extrabold">Order details</h1>
        <div class="container max-w-md mx-auto">
            <div id="order-container">

                <div class="grid grid-cols-2 mb-5">
                    <div>Number of Forms</div>
                    <div>{{ $cartWrapper -> number_of_forms }}</div>

                    <div>Order Total:</div>
                    <div>€{{ $cartWrapper -> current_cost / 100 }}</div>
                </div>

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
        <h1 class="text-center text-2xl font-extrabold">You have nothing in your cart</h1>
        <div class="container max-w-md mx-auto">
            <div id="order-container grid grid-cols-1 md:grid-cols-2">
                <div>
                    <h4>Create An Entry Form</h4>
                    <button><a href="{{ Url('entry')}}">Entry Form</a></button>
                </div>
                <div>
                    <h4>Home Page</h4>
                    <button><a href="{{ Url('/') }}"></a></button>
                </div>
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
    @endif
</div>
