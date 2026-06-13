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
            .bg-white { background-color: var(--glass-bg) !important; color: var(--text-main) !important; border: 1px solid var(--glass-border) !important; backdrop-filter: blur(10px); }
            .bg-gray-100 { background-color: transparent !important; }
            .text-gray-900, .text-gray-800, .text-gray-700, .text-gray-600 { color: var(--text-main) !important; }
            .text-gray-500, .text-gray-400 { color: var(--text-muted) !important; }
            .border-gray-300 { border-color: var(--glass-border) !important; }
            
            /* Input & Forms */
            input, select, textarea { background-color: rgba(15, 23, 42, 0.5) !important; color: white !important; border: 1px solid var(--glass-border) !important; }
            input:focus, select:focus, textarea:focus { border-color: var(--accent-blue) !important; outline: none !important; box-shadow: 0 0 0 1px var(--accent-blue) !important; }
            
            /* Buttons */
            .bg-gray-800 { background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue)) !important; border: none !important; color: white !important; }
            .bg-gray-800:hover { opacity: 0.9 !important; box-shadow: 0 10px 20px rgba(129, 140, 248, 0.3) !important; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
