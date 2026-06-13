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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Deep Space Learning Theme Override -->
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                --bg-primary: #0F172A;
                --bg-secondary: #1E293B;
                --accent-blue: #38BDF8;
                --accent-purple: #818CF8;
                --glass-bg: rgba(30, 41, 59, 0.6);
                --glass-border: rgba(255, 255, 255, 0.08);
                --text-main: #F8FAFC;
                --text-muted: #94A3B8;
            }
            body { font-family: 'Outfit', sans-serif !important; background-color: var(--bg-primary) !important; color: var(--text-main) !important; position: relative; }
            
            /* Ambient Glow */
            body::before { content: ''; position: fixed; top: -10%; left: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, rgba(129, 140, 248, 0.15) 0%, transparent 60%); border-radius: 50%; z-index: -1; filter: blur(40px); }
            body::after { content: ''; position: fixed; bottom: -20%; right: -10%; width: 60vw; height: 60vw; background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 60%); border-radius: 50%; z-index: -1; filter: blur(50px); }

            /* Color Overrides */
            .bg-white, .bg-indigo-50\/50 { background-color: var(--glass-bg) !important; color: var(--text-main) !important; border: 1px solid var(--glass-border) !important; backdrop-filter: blur(10px); }
            .bg-gray-100, .bg-gray-50 { background-color: transparent !important; }
            .text-gray-800, .text-gray-900, .text-gray-700 { color: var(--text-main) !important; }
            .text-gray-500 { color: var(--text-muted) !important; }
            .border-b, .border, .border-gray-200, .border-gray-100, .border-indigo-100 { border-color: var(--glass-border) !important; }
            header.bg-white, nav.bg-white { background: rgba(15, 23, 42, 0.8) !important; border-bottom: 1px solid var(--glass-border) !important; box-shadow: none !important; backdrop-filter: blur(16px); }
            .shadow-sm, .shadow { box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important; }
            
            /* Input & Forms */
            input, select, textarea { background-color: rgba(15, 23, 42, 0.5) !important; color: white !important; border: 1px solid var(--glass-border) !important; }
            input:focus, select:focus, textarea:focus { border-color: var(--accent-blue) !important; outline: none !important; box-shadow: 0 0 0 1px var(--accent-blue) !important; }
            .hover\:bg-gray-50:hover { background-color: rgba(255, 255, 255, 0.05) !important; }
            
            /* Cards / Elements */
            td { color: var(--text-main) !important; }
            th { color: var(--text-muted) !important; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
            .bg-blue-100 { background: rgba(56, 189, 248, 0.15) !important; color: var(--accent-blue) !important; }
            .bg-gray-200 { background: rgba(255, 255, 255, 0.1) !important; color: var(--text-main) !important; }
            svg.text-gray-800 { color: var(--text-main) !important; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
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
    </body>
</html>
