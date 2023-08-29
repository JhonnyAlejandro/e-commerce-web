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

        @yield('scripts')
    </body>
</html>
