@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                    {{ __('Danh sách thành viên') }}
                </h2>
            </div>
            <div class="container mx-auto">
                <div class="flex justify-between my-4">
                    <!-- Nút Thêm thành viên -->
                    <a href="{{ route('members.create') }}">
                        <x-primary-button class="px-6 py-3 text-lg">
                            <i class="fas fa-user-plus mr-2"></i> {{ __('Thêm thành viên') }}
                        </x-primary-button>
                    </a>
                    <!-- Ô tìm kiếm -->
                    <x-text-input type="text" id="searchInput" placeholder="Tìm kiếm..."
                                  class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-1/2 p-2"/>
                </div>

                <!-- Bảng danh sách thành viên -->
                <x-table-modal
                    :data="$members->map(function($member) {
                        return [
                            'STT'        => $member->id,
                            'Ảnh'        => $member->photo,
                            'Họ Tên'     => $member->name,
                            'Ngày Sinh'  => $member->birth_date,
                            'Giới Tính'  => $member->gender == 'male' ? 'Nam' : 'Nữ', // Chuyển đổi giới tính
                        ];
                    })"
                    editRoute="members.edit"
                    deleteRoute="members.destroy" />
            </div>
        </div>
    </div>
</div>

<script>
    // Lắng nghe sự kiện nhập liệu trong ô tìm kiếm
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase(); // Chuyển giá trị tìm kiếm thành chữ thường
        const rows = document.querySelectorAll('tr'); // Lấy tất cả các dòng trong bảng

        rows.forEach(function (row) {
            const columns = row.querySelectorAll('td'); // Lấy tất cả các cột trong dòng
            if (columns.length > 0) { // Đảm bảo rằng đây là một dòng dữ liệu, không phải tiêu đề
                const name = columns[2].textContent.toLowerCase(); // Giả sử cột thứ 3 là "Họ Tên"
                const birthDate = columns[3].textContent.toLowerCase(); // Cột thứ 4 là "Ngày Sinh"
                const gender = columns[4].textContent.toLowerCase(); // Cột thứ 5 là "Giới Tính"

                // Kiểm tra xem có từ khóa tìm kiếm trong bất kỳ cột nào không
                if (name.includes(filter) || birthDate.includes(filter) || gender.includes(filter)) {
                    row.style.display = ''; // Hiển thị dòng nếu có kết quả
                } else {
                    row.style.display = 'none'; // Ẩn dòng nếu không khớp với kết quả tìm kiếm
                }
            }
        });
    });
</script>

@endsection
