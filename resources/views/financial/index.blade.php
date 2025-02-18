@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
            <h2 class="uppercase text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                Quản lý quỹ tài chính
            </h2>
        </div>
        <div class="flex justify-between items-center my-4">
            <div class="flex gap-4">
                <a href="javascript:history.go(-1)">
                    <x-secondary-button class="px-6 py-3 text-lg">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </x-secondary-button>
                </a>
            </div>
            <x-text-input type="text" id="searchInput" placeholder="Tìm kiếm..."
                          class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-1/4"/>
        </div>
        <!-- Tổng quan số dư -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-green-600 font-semibold">Tổng Thu</h3>
                <p class="text-purple-600 font-bold mt-2">+50,000,000 VND</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-red-600 font-semibold">Tổng Chi</h3>
                <p class="text-purple-600 font-bold mt-2">-20,000,000 VND</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-black font-semibold">Số dư</h3>
                <p class="text-purple-600 font-bold mt-2">30,000,000 VND</p>
            </div>
        </div>

        <!-- Trạng thái các quỹ -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <!-- Quỹ Hoạt động -->
            <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-purple-600 font-semibold">Quỹ Hoạt động</h3>
                <div class="w-full bg-purple-200 h-2 rounded-lg overflow-hidden mt-2">
                    <div class="bg-purple-500 h-2 rounded-lg" style="width: 70%;"></div>
                </div>
                <p class="text-purple-600 font-bold mt-2">70% Sử dụng</p>
            </div>
            <!-- Quỹ Dự phòng -->
            <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-yellow-500">
                <h3 class="text-yellow-600 font-semibold">Quỹ Dự phòng</h3>
                <div class="w-full bg-yellow-200 h-2 rounded-lg overflow-hidden mt-2">
                    <div class="bg-yellow-500 h-2 rounded-lg" style="width: 40%;"></div>
                </div>
                <p class="text-yellow-600 font-bold mt-2">40% Sử dụng</p>
            </div>
            <!-- Quỹ Đầu tư -->
            <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-gray-500">
                <h3 class="text-gray-600 font-semibold">Quỹ Đầu tư</h3>
                <div class="w-full bg-gray-200 h-2 rounded-lg overflow-hidden mt-2">
                    <div class="bg-gray-500 h-2 rounded-lg" style="width: 30%;"></div>
                </div>
                <p class="text-gray-600 font-bold mt-2">30% Sử dụng</p>
            </div>
        </div>

        <!-- Form nhập giao dịch -->
        <div class="mb-4 bg-gray-50 p-8 rounded-lg shadow">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Số tiền</label>
                    <input type="number"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Loại giao dịch</label>
                    <select
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="income">Tiền vào</option>
                        <option value="expense">Tiền ra</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Quỹ liên quan</label>
                    <select
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="quy_hoat_dong">Quỹ Hoạt động</option>
                        <option value="quy_du_phong">Quỹ Dự phòng</option>
                        <option value="quy_dau_tu">Quỹ Đầu tư</option>
                    </select>
                </div>
            </div>
            <x-primary-button class="mt-4 w-full px-6 py-3 text-lg">
                Ghi nhận giao dịch
            </x-primary-button>
        </div>

        <!-- Bảng danh sách giao dịch -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white shadow-md rounded-l">
                <thead class="text-black">
                <tr class="font-bold text-lg">
                    <th class="p-3 text-left">Ngày</th>
                    <th class="p-3 text-left">Số tiền</th>
                    <th class="p-3 text-left">Loại giao dịch</th>
                    <th class="p-3 text-left">Quỹ liên quan</th>
                    <th class="p-3 text-center">Hành động</th>
                </tr>
                </thead>
                <tbody class="text-gray-700">
                <tr class="border-b">
                    <td class="p-3">01/02/2025</td>
                    <td class="p-3 text-green-600">+50,000,000 VND</td>
                    <td class="p-3">Tiền vào</td>
                    <td class="p-3">Quỹ Hoạt động</td>
                    <td class="p-3 text-center">
                        <button
                            class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-blue-500/10 active:bg-blue-500/30"
                            type="button">
                                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                    <i class="fas fa-edit text-blue-500"></i>
                                </span>
                        </button>
                        <button type="button"
                                class="delete-btn relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-red-500/10 active:bg-red-500/30 text-red-500">
                                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                    <i class="fas fa-trash-alt text-red-500"></i>
                                </span>
                        </button>
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="p-3">02/02/2025</td>
                    <td class="p-3 text-red-600">-20,000,000 VND</td>
                    <td class="p-3">Tiền ra</td>
                    <td class="p-3">Quỹ Dự phòng</td>
                    <td class="p-3 text-center">
                        <button
                            class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-blue-500/10 active:bg-blue-500/30"
                            type="button">
                                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                    <i class="fas fa-edit text-blue-500"></i>
                                </span>
                        </button>
                        <button type="button"
                                class="delete-btn relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-red-500/10 active:bg-red-500/30 text-red-500">
                                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                    <i class="fas fa-trash-alt text-red-500"></i>
                                </span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
