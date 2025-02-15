@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                    {{ __('Thêm Thành Viên Mới') }}
                </h2>
            </div>
            <form id="addForm" method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Họ và Tên')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                </div>
                <div class="mb-4">
                    <x-input-label for="birth_date" :value="__('Ngày Sinh')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="gender" :value="__('Giới Tính')" />
                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="male">Nam</option>
                        <option value="female">Nữ</option>
                    </select>
                </div>
                <div class="mb-4 flex items-center space-x-4">
                    <x-input-label for="photo" :value="__('Ảnh Đại Diện')" class="whitespace-nowrap" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" onchange="previewImageUrl()" />
                    <div class="mt-2">
                        <img src="#" id="previewImage" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-gray-300 hidden" alt="Ảnh xem trước" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-input-label for="born_id" :value="__('Người Sinh Ra')" />
                    <select id="born_id" name="born_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Chọn người sinh ra --</option>
                        @foreach($members as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-3 mt-4">
                    <a href="{{ route('members.index') }}">
                        <x-secondary-button>{{ __('Trở về') }}</x-secondary-button>
                    </a>
                    <x-primary-button id="saveBtn">{{ __('Thêm Thành Viên') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewImageUrl() {
        const preview = document.getElementById('previewImage');
        const file = document.getElementById('photo').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
    document.getElementById("saveBtn").addEventListener("click", function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Xác nhận thêm?",
            text: "Bạn có chắc chắn muốn thêm thành viên này?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, thêm!",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("addForm").submit();
            }
        });
    });
</script>
@endsection