<div>
    @if($latestOrder)

        <div class="custom-bg-color container mt-3 rounded-lg shadow mx-auto h-full pt-5 pb-10">
            <h1 class="p-3 custom-red-text text-3xl font-bold text-center">Thanks for your Order, {{ $firstName }}</h1>
            <div class="container max-w-lg mx-auto">
                <div id="order-container">

                    <div class="mx-5 my-3">
                        <div>
                            <p><strong>Order Number:</strong> {{ $latestOrder -> order_number }}</p>
                        </div>
                        <div>
                            <p><strong>Number of Forms:</strong> {{ $latestOrder -> number_of_forms }}</p>
                        </div>

                        <div>
                            <strong>Total Cost Of Order:</strong> €{{  number_format($latestOrder -> amount_paid_cents / 100, 2) }}
                        </div>

                        <p class="py-3 text-xl">Best of luck in the upcoming competition!</p>
                        <div class="flex mt-2 xs:mt-0 justify-center">
                            <button type="button" class="mx-2 px-2 h-10 text-base font-medium border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white custom-bg-red-color text-white">
                                <a href="{{ URL('entry') }}" wire:navigate>Entry Form</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="custom-bg-color container mt-3 rounded-lg shadow mx-auto h-full pt-5 pb-10">
            <h1 class="p-3 custom-red-text text-3xl font-bold text-center">Sorry, {{ $firstName }}.</h1>
            <div class="container max-w-lg mx-auto">
                <div id="order-container">

                    <div class="mx-5 my-3">
                        Your order has not been placed. Please contact info@champorchimp.ie.
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
