<div>
    <div class="relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-50 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
        <div class="absolute left-[max(-7rem,calc(50%-52rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
          <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#CB3057] to-[#F48142] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
        </div>
        <div class="absolute left-[max(45rem,calc(50%+8rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
          <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#CB3057] to-[#F48142] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
        </div>
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
          <p class="text-sm leading-6 text-gray-900">
            <strong class="font-semibold">Special Offer</strong><svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>Buy 2 Entry Forms, get a 3rd free!
          </p>
          <a href="{{ url('entry') }}" wire:navigate class="flex-none rounded-full bg-gray-900 px-3.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Go To Entry Form<span aria-hidden="true">&rarr;</span></a>
        </div>
        <div class="flex flex-1 justify-end">
          <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
            <span class="sr-only">Dismiss</span>
            <svg class="h-5 w-5 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
          </button>
        </div>
    </div>

    @if($cart)
        <div x-data="{ showDeleteModal: false, deletingEntry: null }" class="custom-bg-color container mt-3 rounded-lg shadow mx-auto h-full flex justify-center">
            <div class="max-w-md mx-auto custom-bg-color">
                <div id="order-container">
                    
                    <h1 class="text-5xl font-extrabold mx-auto custom-orange-text text-center">Order details</h1>
                    <div class="grid grid-cols-2 mb-5 mx-5 my-3">
                        <div>Number of Forms:</div>
                        <div>{{ $cartWrapper -> number_of_forms }}</div>

                        <div>Order Total:</div>
                        <div>€{{ number_format($cartWrapper -> current_cost / 100, 2) }}</div>
                    </div>

                    @foreach($cart as $details)
                        @livewire(FormDisplay::class, ['details' => $details, 'loopIteration' => $loop->iteration, 'total' => count($cart)], key($details->id))
                        <hr>
                    @endforeach
                    
                </div>
                <form action="POST" wire:submit="checkout">
                    @csrf
                    <div class="col-span-2 flex justify-center mt-2 mb-5">
                        <button type="submit" class="mx-3 px-4 h-10 text-base font-medium text-white bg-blue-800 rounded-s hover:bg-gray-900">
                            Checkout
                        </button>
                        <button type="button" class="mx-3 px-4 h-10 text-base font-medium text-white bg-green-800 rounded-s hover:bg-gray-900"><a href="{{ url('entry') }}" wire:navigate>Add Another Entry</a></button>
                    </div>
               </form>
            </div>
            <div x-show="showDeleteModal" x-on:close-modal.window="showDeleteModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
                <div class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 bg-white w-80 shadow-lg rounded-lg p-8">
                  <h3 class="text-lg font-medium text-gray-900">Confirm Deletion</h3>
                  <p class="mt-4 text-sm text-gray-500">Are you sure you want to delete this entry?</p>
                  <div class="mt-5 flex justify-end space-x-2">
                      <div x-show="showDeleteModal" x-on:close-modal.window="showDeleteModal = false">
                        <button class="mx-3 px-4 h-10 text-base font-medium text-white custom-bg-red-color border-0 border-s border-gray-700 rounded-e hover:bg-gray-900" x-on:click="$wire.deleteEntryForm('{{ $details->id }}')">Confirm Delete</button>
                      </div>

                      <button x-show="showDeleteModal" x-on:close-modal.window="showDeleteModal = false" x-on:click="showDeleteModal = false">
                        Cancel
                      </button>
                  </div>
                </div>
            </div>
        </div>
       
    @else

      <div class="custom-bg-color container mt-3 rounded-lg shadow mx-auto h-full flex justify-center">
        <div class="container max-w-md mx-auto ">
            <h1 class="text-center text-2xl font-extrabold custom-red-text mt-3 custom-bg-color">You have nothing in your cart</h1>
            <div id="order-container">
              <div id="how-to-input-info-container" class="custom-alert-box" role="alert">
                <img id="irish-chimp" src="{{ URL('images/shopping-chimp.jpg') }}" >

                <h1 class="custom-red-text font-extrabold text-2xl">Empty Cart?</h1>

                <p>
                    Fill in an entry form to be in with a chance to win our amazing prizes
                </p>
              </div>

              <div class="col-span-2 flex justify-center mt-2 xs:mt-0 mb-3">
                <!-- Authentication -->
                <button wire:click="logout" class="text-start text-black">
                  <x-responsive-nav-link>
                      {{ __('Log Out') }}
                  </x-responsive-nav-link>
                </button>
                <button type="button" class="mx-2 px-2 h-10 text-base font-medium border bg-green-500 border-gray-700 rounded-e hover:bg-gray-900" >
                    <a href="{{ url('entry') }}" wire:navigate>Entry Form</a>
                </button>

                
              </div>
            </div>
          </div>
      </div>
    @endif
</div>
