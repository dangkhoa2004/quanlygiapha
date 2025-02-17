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
    <style>
        html,
        body,
        * {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            overscroll-behavior: contain;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .font-sans {
            font-family: Roboto, Helvetica, Arial, sans-serif !important;
        }

        html::-webkit-scrollbar,
        *::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        body {
            background-color: #e8c77b;
            background-image: url(https://phanmemgiapha.vn/public/upload/theme/hoa-van-trans.png);
            background-repeat: repeat;
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <img src="https://img.pikbest.com/origin/10/50/43/11HpIkbEsTnIe.png!sw800" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>