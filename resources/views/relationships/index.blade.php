@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
            <h2 class="uppercase text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                Quản lý mối quan hệ
            </h2>
        </div>
        <div class="flex justify-between items-center my-4">
            <div class="flex gap-4">
                <a href="{{ route('members.index') }}">
                    <x-secondary-button class="px-6 py-3 text-lg">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại
                    </x-secondary-button>
                </a>
            </div>
        </div>
        <div class="mb-4 bg-gray-50 p-8 rounded-lg shadow">
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
        <!-- Bộ lọc bảng danh sách giao dịch -->
        <div class="flex justify-between items-center my-4">
            <div class="flex gap-4">
                <a>
                    <x-primary-button class="px-6 py-3 text-lg">
                        <i class="fas fa-filter mr-2"></i>Bộ lọc
                    </x-primary-button>
                </a>
            </div>
            <x-text-input type="text" id="searchInput" placeholder="Tìm kiếm..."
                          class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-1/4"/>
        </div>
        <div class="overflow-x-auto">
            @php
            $members = collect([
            (object) ['id' => 1, 'name' => 'Trần Thị Mai', 'relatedName' => 'Trần Văn Dũng', 'typeRelated' => 'Đời thứ
            2'],
            (object) ['id' => 2, 'name' => 'Trần Văn Tú', 'relatedName' => 'Trần Thị Hạnh', 'typeRelated' => 'Đời thứ
            3']
            ]);
            @endphp
            <x-table-modal
                :data="$members->map(fn($member) => [
        'STT' => $member->id,
        'Thành viên' => $member->name ?? 'Chưa có tên',
        'Liên kết với' => $member->relatedName ?: 'Không có',
        'Loại quan hệ' => $member->typeRelated ?: 'Chưa xác định',
    ])"
                editRoute="members.edit"
                deleteRoute="members.destroy"/>

        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const filter = this.value.trim().toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(function (row) {
                    const rowText = row.textContent.trim().toLowerCase();
                    row.style.display = rowText.includes(filter) ? '' : 'none';
                });
            });
        }
    });
</script>

@endsection
