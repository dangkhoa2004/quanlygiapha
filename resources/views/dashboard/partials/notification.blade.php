<body class="bg-gray-200 flex justify-center">
<div class="w-full max-w-md bg-white shadow-lg rounded-lg p-4">
    <h2 class="text-xl font-bold mb-4">Thông báo</h2>

    <div class="flex gap-4 border-b pb-2 mb-4 text-sm">
        <button class="font-semibold text-black border-b-2 border-black pb-1">Tất cả</button>
        <button class="text-gray-500 hover:text-blue-600 pb-1.5">Chưa đọc</button>
    </div>

    <!-- Nhóm các yêu cầu duyệt lại -->
    <h3 class="font-semibold mb-2 text-gray-700">Duyệt yêu cầu</h3>
    <div class="mt-4 overflow-y-auto max-h-40 space-y-4">
        <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
            <div class="flex items-center">
                <img src="https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"
                     class="w-12 h-12 rounded-full mr-3" alt="User">
                <div>
                    <p class="font-medium">Đăng Khoa</p>
                    <p class="text-sm text-gray-500">1 ngày trước</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <x-primary-button class="px-6 py-3 text-lg">Xác nhận</x-primary-button>
                <x-secondary-button class="px-6 py-3 text-lg">Xoá</x-secondary-button>
            </div>
        </div>
        <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
            <div class="flex items-center">
                <img src="https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"
                     class="w-12 h-12 rounded-full mr-3" alt="User">
                <div>
                    <p class="font-medium">Minh Tran</p>
                    <p class="text-sm text-gray-500">5 ngày trước</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <x-primary-button class="px-6 py-3 text-lg">Xác nhận</x-primary-button>
                <x-secondary-button class="px-6 py-3 text-lg">Xoá</x-secondary-button>
            </div>
        </div>
        <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
            <div class="flex items-center">
                <img src="https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"
                     class="w-12 h-12 rounded-full mr-3" alt="User">
                <div>
                    <p class="font-medium">Minh Tran</p>
                    <p class="text-sm text-gray-500">5 ngày trước</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <x-primary-button class="px-6 py-3 text-lg">Xác nhận</x-primary-button>
                <x-secondary-button class="px-6 py-3 text-lg">Xoá</x-secondary-button>
            </div>
        </div>
        <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
            <div class="flex items-center">
                <img src="https://i.ibb.co/MxkwZh2C/original-9f4a9b65d528a341463aacf53847bc17.webp"
                     class="w-12 h-12 rounded-full mr-3" alt="User">
                <div>
                    <p class="font-medium">Minh Tran</p>
                    <p class="text-sm text-gray-500">5 ngày trước</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <x-primary-button class="px-6 py-3 text-lg">Xác nhận</x-primary-button>
                <x-secondary-button class="px-6 py-3 text-lg">Xoá</x-secondary-button>
            </div>
        </div>
    </div>

    <!-- Thông báo hôm nay -->
    <h3 class="font-semibold mb-2 text-gray-700 mt-4">Hôm nay</h3>
    <div class="mt-4 overflow-y-auto max-h-40 space-y-4">
        <div class="flex items-center p-3 border rounded-lg bg-gray-50">
            <i class="fas fa-comment text-green-500 text-lg mr-3"></i>
            <p class="text-sm"><span class="font-medium">Đức Trịnh</span> đã nhắc đến bạn trong một bài viết.</p>
        </div>
        <div class="flex items-center p-3 border rounded-lg bg-gray-50">
            <i class="fas fa-users text-blue-500 text-lg mr-3"></i>
            <p class="text-sm"><span class="font-medium">Đạt Black</span> đã nhắc đến bạn trong nhóm.</p>
        </div>
        <div class="flex items-center p-3 border rounded-lg bg-gray-50">
            <i class="fas fa-heart text-red-500 text-lg mr-3"></i>
            <p class="text-sm"><span class="font-medium">Ngọc Bùi</span> đã bày tỏ cảm xúc về bài viết của bạn.</p>
        </div>
    </div>
</div>
</body>
