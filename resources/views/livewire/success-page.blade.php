<div>
    @if($latestOrder)
        <h1 class="text-center text-2xl font-extrabold">Thanks for your Order, {{ $firstName }}</h1>
        <div class="container max-w-md mx-auto">
            <div id="order-container">

                <div class="grid grid-cols-2">

                    <div>Order Number</div>
                    <div>{{ $latestOrder -> order_number }}</div>


                    <div>Number of Forms</div>
                    <div>{{ $latestOrder -> number_of_forms }}</div>

                    <div>Total Cost of Order</div>
                    <div>€{{ ($latestOrder -> amount_paid_cents) / 100 }}</div>
                </div>
            </div>
        </div>
    @else
        Cyka Blyat
    @endif
</div>
