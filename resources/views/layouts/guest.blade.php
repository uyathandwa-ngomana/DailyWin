<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght@400&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-on-surface antialiased">
        <div class="min-h-screen bg-background px-gutter py-xl">
            <div class="mx-auto flex min-h-[calc(100vh-64px)] w-full max-w-md flex-col justify-center">
                <div class="mb-lg flex flex-col items-center text-center">
                    <a href="/" class="mb-md flex h-16 w-16 items-center justify-center rounded-xl bg-primary-container text-on-primary-container shadow-sm">
                        <span class="material-symbols-outlined text-[40px]">task_alt</span>
                    </a>
                    <h1 class="text-2xl font-bold text-on-surface">DailyWin</h1>
                    <p class="text-sm text-on-surface-variant">Taskie AZU</p>
                </div>

                <div class="dw-card p-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
