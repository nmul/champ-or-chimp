<?php

use App\Models\User;
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
    <div id="" class="low-opacity-bg-image" style="background-image: url({{ URL('/images/lasVegasLessSky1200.jpg')}});">
        

        <div class="container pt-3 mx-auto h-full">
            <div id="how-to-input-info-container" class="custom-alert-box-large block" role="alert">
                <img id="irish-chimp" src="{{ URL('images/gorilla-coach.jpg') }}" >

                <h1 class="custom-red-text font-extrabold text-2xl">Champ Or Chimp</h1>

                <p class="text-xl">
                    The best sports prediction competition there is!
                </p>
            </div>

            <div class="flex justify-center mx-auto">
                <form wire:submit="register">
                    <h1 class="text-center text-xl mb-3">Register</h1>
                    <!-- Name -->
                    <div class="mt-4">
                        <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-80" type="text" name="first_name" required autofocus autocomplete="first_name" placeholder="First Name" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>
        
                    <div class="mt-4">
                        <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-80" type="text" name="last_name" required autofocus autocomplete="last_name" placeholder="Last Name"/>
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
        
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-80" type="email" name="email" required autocomplete="username" placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
        
                    <!-- Password -->
                    <div class="mt-4">
        
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-80"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" placeholder="Password" />
        
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-80"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password"  />
        
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
        
                    <div class="flex items-center justify-start mt-4">
                        <a class="underline text-md text-gray-900 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                            {{ __('Already registered?') }}
                        </a>
        
                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

        </div>


        <div class="container grid grid-cols-1 md:grid-cols-2 mx-auto py-48">
            <div class="flex flex-col justify-center align-middle">
                <h1 class="text-4xl text-center">Champ Or Chimp</h1>
                <p class="font-bold text-xl text-center">Predict the outcomes of 14 sporting events to be in with a chance to win a trip to Las Vegas!</p>
            </div>
            <div class="form-wrapper md:ml-10 text-center flex justify-center mb-5 rounded">
                
            </div>
        </div>
    </div>
</div>
