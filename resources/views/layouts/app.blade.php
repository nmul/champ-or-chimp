<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Champ or Chimp') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&display=swap');
        </style>
        <link rel="shortcut icon" type="image/jpg" href="{{ URL('/images/favicon.ico') }}"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

                <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
                <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                <script src="https://kit.fontawesome.com/b850c02dfa.js" crossorigin="anonymous"></script>
    <body x-data class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>
