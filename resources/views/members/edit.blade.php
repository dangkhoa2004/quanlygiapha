@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                    {{ __('Chỉnh Sửa Thành Viên') }}
                </h2>
            </div>
            <form id="editForm" method="POST" action="{{ route('members.update', $member->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Họ và tên -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Họ và Tên')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $member->name }}" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Ngày sinh -->
                <div class="mb-4">
                    <x-input-label for="birth_date" :value="__('Ngày Sinh')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ $member->birth_date }}" required />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>
                <!-- Giới tính -->
                <div class="mb-4">
                    <x-input-label for="gender" :value="__('Giới Tính')" />
                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="male" {{ $member->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="feMale" {{ $member->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
                <!-- Ảnh Đại Diện -->
                <div class="mb-4 flex items-center">
                    <x-input-label for="photo" :value="__('Ảnh Đại Diện')" class="mr-4" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="text" name="photo" value="{{ $member->photo }}" oninput="previewImageUrl()" onpaste="previewImageUrl()" required autofocus />
                    <div class="ml-4 w-full">
                        <img id="previewImage" src="{{ $member->photo }}" alt="Preview" class="w-32 h-32 object-cover rounded-full" />
                    </div>
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="born_id" :value="__('Người Sinh Ra')" />
                    <select id="born_id" name="born_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Chọn người sinh ra --</option>
                        @foreach($members as $m)
                        <option value="{{ $m->id }}" {{ isset($relationship) && $m->id == optional($relationship)->born_id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('born_id')" class="mt-2" />
                </div>
                <!-- Nút cập nhật & Trở về -->
                <div class="flex justify-end space-x-3 mt-4">
                    <a href="{{ route('members.index') }}">
                        <x-secondary-button>{{ __('Trở về') }}</x-secondary-button>
                    </a>
                    <x-primary-button id="updateBtn">{{ __('Cập Nhật Thành Viên') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("updateBtn").addEventListener("click", function(event) {
        function previewImageUrl() {
            const preview = document.getElementById('previewImage');
            const photoUrl = document.getElementById('photo').value;
            if (photoUrl) {
                preview.src = photoUrl;
            }
        }
        event.preventDefault();
        Swal.fire({
            title: "Xác nhận cập nhật?",
            text: "Bạn có chắc chắn muốn cập nhật thông tin thành viên này?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, cập nhật!",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("editForm").submit();
            }
        });
    });
</script>
@endsection