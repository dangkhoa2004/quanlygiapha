@extends('layouts.app')

@section('content')

<div class="py-12 w-full min-w-max table-auto text-left">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <div class="max-w-xl mx-auto py-2">
            <h2 class="uppercase text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                Quản lý mối quan hệ thành viên
            </h2>
        </div>
        <div class="flex justify-between items-center my-8">
            <div class="flex gap-4">
                <a href="javascript:history.go(-1)">
                    <x-secondary-button class="px-6 py-3 text-lg">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </x-secondary-button>
                </a>
            </div>
            <x-text-input type="text" id="searchInput" placeholder="Tìm kiếm..."
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-1/4" />
        </div>
        <div class="mb-8 bg-gray-50 p-8 rounded-lg shadow">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Thành viên</label>
                    <input type="number" class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Liên kết với</label>
                    <input type="number" class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Loại quan hệ</label>
                    <select class="w-full border-gray-300 rounded-lg p-2 bg-gray-100" disabled>
                        <option>---</option>
                    </select>
                </div>
            </div>
            <x-primary-button class="mt-4 w-full px-6 py-3 text-lg">
                <i class="fas fa-user-plus mr-2"></i> Thêm mới
            </x-primary-button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white shadow-md rounded-lg">
                <thead class=" text-black">
                    <tr class="font-bold text-lg">
                        <th class="p-3 text-left">Thành viên</th>
                        <th class="p-3 text-left">Liên kết với</th>
                        <th class="p-3 text-left">Loại quan hệ</th>
                        <th class="p-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="border-b">
                        <td class="p-3">Trần Thị Mai</td>
                        <td class="p-3">Trần Văn Dũng</td>
                        <td class="p-3">Đời thứ 2</td>
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
                        <td class="p-3">Trần Văn Tú</td>
                        <td class="p-3">Trần Thị Hạnh</td>
                        <td class="p-3">Đời thứ 3</td>
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