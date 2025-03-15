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
        
        <!-- Additional Font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gray-100 to-white">
        <div class="min-h-screen">
            <!-- Logo Area -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center">
                        <a href="/" class="text-2xl font-bold text-gray-800">
                            PT. Internet Pratama Indonesia
                        </a>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow py-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <span class="text-sm text-gray-600 flex items-center justify-center gap-2">
                        © {{ date('Y') }} PT. Internet Pratama Indonesia. All rights reserved. Developed by 
                        <a href="https://fahrezifauzan.vercel.app/" target="_blank" class="text-blue-500 hover:underline flex items-center gap-1">    
                            <img src="{{ asset('images/frz_sign.png') }}" alt="FRZ Logo" class="h-4 w-auto"> 
                        </a>
                    </span>
                </div>
            </footer>
        </div>
    </body>
</html> 