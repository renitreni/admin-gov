<!DOCTYPE html>
<html lang="en">
<head>
    <!-- GUEST -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="w-full content-center h-screen">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>