<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Chủ Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
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
<div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-red-500 selection:text-white">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <div class="flex lg:justify-center lg:col-start-2">
                <h1 class="text-3xl font-bold text-red-600">Laravel</h1>
            </div>
            <nav class="flex justify-end">
                <a href="{{ url('/trang-chu') }}" class="rounded-md px-3 py-2 text-black hover:text-gray-700">Trang
                    Chủ</a>
                <a href="{{ route('login') }}" class="ml-4 rounded-md px-3 py-2 text-black hover:text-gray-700">Đăng
                    Nhập</a>
                <a href="{{ route('register') }}" class="ml-4 rounded-md px-3 py-2 text-black hover:text-gray-700">Đăng
                    Ký</a>
            </nav>
        </header>

        <main class="mt-6">
            <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                <a href="https://laravel.com/docs"
                   class="flex flex-col items-start gap-6 rounded-lg bg-white p-6 shadow-md hover:ring-2 hover:ring-red-500">
                    <h2 class="text-xl font-semibold text-black">Tài liệu Laravel</h2>
                    <p class="text-sm text-gray-600">Laravel có tài liệu đầy đủ hướng dẫn từng bước giúp bạn nhanh chóng
                        làm quen và nâng cao kỹ năng lập trình của mình.</p>
                </a>

                <a href="https://laracasts.com"
                   class="flex flex-col items-start gap-6 rounded-lg bg-white p-6 shadow-md hover:ring-2 hover:ring-red-500">
                    <h2 class="text-xl font-semibold text-black">Laracasts</h2>
                    <p class="text-sm text-gray-600">Laracasts cung cấp hàng nghìn video hướng dẫn về Laravel, PHP và
                        JavaScript, giúp bạn nâng cao kỹ năng lập trình.</p>
                </a>
                <a href="https://laravel-news.com"
                   class="flex flex-col items-start gap-6 rounded-lg bg-white p-6 shadow-md hover:ring-2 hover:ring-red-500">
                    <h2 class="text-xl font-semibold text-black">Tin tức Laravel</h2>
                    <p class="text-sm text-gray-600">Cập nhật những tin tức mới nhất về Laravel, các bản cập nhật, gói
                        thư viện và hướng dẫn hữu ích.</p>
                </a>
            </div>
        </main>

        <footer class="py-16 text-center text-sm text-gray-600">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</div>
</body>

</html>
