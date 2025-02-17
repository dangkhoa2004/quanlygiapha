@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                <h2 class="uppercase text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                    Quản lý thành viên
                </h2>
            </div>
            <div class="container mx-auto">
                <div class="flex justify-between items-center my-4">
                    <div class="flex gap-4">
                        <a href="{{ route('members.create') }}">
                            <x-primary-button class="px-6 py-3 text-lg">
                                <i class="fas fa-user-plus mr-2"></i> Thêm mới
                            </x-primary-button>
                        </a>
                        <a href="{{ route('quan-ly-moi-quan-he') }}">
                            <x-primary-button class="px-6 py-3 text-lg">
                                <i class="fas fa-user-plus mr-2"></i> Bảng quan hệ
                            </x-primary-button>
                        </a>
                        <a href="{{ route('quan-ly-tai-chinh') }}">
                            <x-primary-button class="px-6 py-3 text-lg">
                                <i class="fas fa-user-plus mr-2"></i> Bảng tài chính
                            </x-primary-button>
                        </a>
                    </div>
                    <x-text-input type="text" id="searchInput" placeholder="Tìm kiếm..."
                        class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-1/4" />
                </div>
                <x-table-modal
                    :data="$members->map(function($member) {
                        return [
                            'STT'        => $member->id,
                            'Ảnh'        => $member->photo,
                            'Họ Tên'     => $member->name,
                            'Ngày Sinh'  => $member->birth_date,
                            'Giới Tính'  => $member->gender == 'male' ? 'Nam' : 'Nữ',
                        ];
                    })"
                    editRoute="members.edit"
                    deleteRoute="members.destroy" />
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('tr');
        rows.forEach(function(row) {
            const columns = row.querySelectorAll('td');
            if (columns.length > 0) {
                const name = columns[2].textContent.toLowerCase();
                const birthDate = columns[3].textContent.toLowerCase();
                const gender = columns[4].textContent.toLowerCase();
                if (name.includes(filter) || birthDate.includes(filter) || gender.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });
</script>

@endsection