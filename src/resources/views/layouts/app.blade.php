<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-sky-50">
            @include('layouts.navigation')

            @if (session('success'))
                <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-6xl mx-auto mt-4" role="alert">
                {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-6xl mx-auto mt-4" role="alert">
                    {{ session('danger') }}
                </div>
            @endif
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow max-w-8xl w-full">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <footer class="py-4 bg-sky-50">
            <p class="text-center">©2025 CoCoLog. All Rights Reserved.</p>
         </footer>
    </body>
</html>
