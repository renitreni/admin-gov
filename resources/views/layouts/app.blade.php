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

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }

        .button-container {
            position: relative;
            cursor: pointer;
        }

        .button-base {
            width: 160px;
            height: 160px;
            background-color: #d1d5db;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .button-top {
            width: 128px;
            height: 128px;
            background-color: #dc2626;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            transition: all 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .button-shine {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), transparent);
            border-radius: 64px 64px 0 0;
            opacity: 0.3;
            transition: opacity 0.2s ease;
        }

        .button-text {
            color: white;
            font-weight: bold;
            font-size: 21px;
            z-index: 10;
            user-select: none;
            transition: transform 0.2s ease;
        }

        /* Pulse animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.2;
            }

            100% {
                transform: scale(1);
                opacity: 0.3;
            }
        }

        .pulse-effect {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            background-color: #ef4444;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Hover state */
        .button-container:hover .button-top {
            background-color: #ef4444;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .button-container:hover .button-shine {
            opacity: 0.5;
        }

        .button-container:hover .button-text {
            transform: scale(1.05);
        }

        .button-container:hover .pulse-effect {
            opacity: 0.3;
            animation: pulse 2s infinite;
        }

        /* Active/pressed state */
        .button-container:active .button-top {
            transform: scale(0.9);
            background-color: #b91c1c;
        }

        .button-container:active .button-text {
            transform: scale(0.95);
        }
    </style>
</head>

<body>
    {{ $slot }}

    @livewireScripts
</body>
</html>
