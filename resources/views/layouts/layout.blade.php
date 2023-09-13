<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        @yield('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white">
            <header class="fixed top-0 z-40 w-full">
                <x-navbar />
            </header>
            <main>
                @if (session('notification'))
                    <x-notification>
                        <x-slot name="icon">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-green-400">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"></path>
                            </svg>
                        </x-slot>
                        {{ session('notification') }}
                    </x-notification>
                @endif
                @yield('content')
            </main>
            <footer class="bg-gray-50 border-t-2 border-gray-200">
                <x-footer />
            </footer>
        </div>
        <x-cookie-banner />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        @livewireScripts
        @yield('scripts')
    </body>
</html>
