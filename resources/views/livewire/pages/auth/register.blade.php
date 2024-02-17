<?php

use App\Models\User;
use App\Mail\TestMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <div id="" class="p-5 custom-bg-color mt-2 container mx-auto" style="font-family: 'Inter', sans-serif;">
        

        <div class="container pt-3 mx-auto h-full grid grid-cols-1">
            <div id="how-to-input-info-container" class="custom-alert-box-large mx-auto" role="alert">
                <img id="irish-chimp" src="{{ URL('images/gorilla-coach.jpg') }}" >

                <h1 class="custom-red-text font-extrabold text-2xl">Champ Or Chimp</h1>

                <p class="text-xl">
                    Show off your sports knowledge, compete for amazing prizes, and help fantastic charities!
                </p>
            </div>

            <div class="flex justify-center mx-auto">
                <form wire:submit="register">
                    <h1 class="text-center text-2xl font-bold mb-3">Register to Enter!</h1>
                    <!-- Name -->
                    <div class="mt-4">
                        <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus autocomplete="first_name" placeholder="First Name" aria-placeholder="First Name"/>
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>
        
                    <div class="mt-4">
                        <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autofocus autocomplete="last_name" placeholder="Last Name" aria-placeholder="Last Name"/>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
        
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" placeholder="Email" aria-placeholder="email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
        
                    <!-- Password -->
                    <div class="mt-4">
        
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" placeholder="Password" aria-placeholder="Password"/>
        
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"  aria-placeholder="Confirm Password"/>
        
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
        
                    <div class="flex items-center space-evenly mt-4">
                        <a class="underline inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-sm text-black uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700  active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150" href="{{ route('login') }}" wire:navigate>
                            {{ __('Registered? Login') }}
                        </a>
        
                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div>

            </div>
        </div>
    </div>
</div>
