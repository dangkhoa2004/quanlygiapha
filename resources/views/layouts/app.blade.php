<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quản lý gia phả | Ouransoft</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>
<style>
    html,
    body,
    * {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: all 0.3s ease-out;
    }

    .font-sans {
        font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif !important;
    }

    html::-webkit-scrollbar,
    body::-webkit-scrollbar,
    *::-webkit-scrollbar {
        width: 0;
        height: 0;
    }

    html {
        scrollbar-width: none;
    }

    body {
        scroll-behavior: smooth;
        background-color: #e8c77b;
        background-image: url(https://phanmemgiapha.vn/public/upload/theme/hoa-van-trans.png);
        background-repeat: repeat;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(500px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    main {
        animation: slideDown 0.5s ease-out;
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>