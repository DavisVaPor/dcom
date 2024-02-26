<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/icon.png">
    <title>.:: Intranet DCOM ::.</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased h-screen">
    <x-banner />

    <div class=" bg-gray-100">
        @livewire('navigation-menu')


        <!-- Page Content -->
        <main class="flex h-full w-full bg-gray-800 " :class="{ 'overflow-hidden': isSideMenuOpen }">
            <x-aside />
            <div class="flex flex-col flex-1 w-full overflow-y-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
