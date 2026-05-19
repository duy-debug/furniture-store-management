<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Không có quyền truy cập</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center" x-data="{ countdown: 5 }" x-init="
            let timer = setInterval(() => {
                countdown--;
                if (countdown <= 0) {
                    clearInterval(timer);
                    window.location.href = '/';
                }
            }, 1000);
        ">
            <h1 class="text-6xl font-bold text-gray-300 mb-4">403</h1>
            <p class="text-xl text-gray-700 mb-8">Bạn không có quyền truy cập khu vực này.</p>

            {{-- Countdown circle --}}
            <div class="flex flex-col items-center gap-4">
                <div class="relative w-20 h-20">
                    {{-- Background circle --}}
                    <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 80 80">
                        <circle cx="40" cy="40" r="36" fill="none" stroke="#e5e7eb" stroke-width="4"></circle>
                        <circle cx="40" cy="40" r="36" fill="none" stroke="#6366f1" stroke-width="4"
                                stroke-dasharray="226.2"
                                :stroke-dashoffset="226.2 - (226.2 * (5 - countdown) / 5)"
                                class="transition-all duration-1000 ease-linear"></circle>
                    </svg>
                    {{-- Number --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-indigo-600" x-text="countdown"></span>
                    </div>
                </div>

                <p class="text-sm text-gray-500">Về Trang chủ sau <span x-text="countdown"></span>s</p>

                <a href="/" class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 underline">
                    Về ngay
                </a>
            </div>
        </div>
    </div>
</body>
</html>
