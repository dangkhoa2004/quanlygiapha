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
            <form id="editForm" method="POST" action="{{ route('members.update', $member->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Họ và Tên')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        value="{{ $member->name }}" required autofocus />
                </div>
                <div class="mb-4">
                    <x-input-label for="birth_date" :value="__('Ngày Sinh')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                        value="{{ $member->birth_date }}" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="gender" :value="__('Giới Tính')" />
                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="male" {{ $member->gender == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ $member->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
                <div class="mb-4 flex items-center space-x-4">
                    <x-input-label for="photo" :value="__('Ảnh Đại Diện')" class="whitespace-nowrap" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" onchange="previewImageUrl()" />
                    @if($member->photo)
                    <div class="mt-2">
                        <img src="{{$member->photo }}" id="previewImage" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-gray-300" alt="Ảnh xem trước" />
                    </div>
                    @endif
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
                </div>>
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
    function previewImageUrl() {
        const preview = document.getElementById('previewImage');
        const photoUrl = document.getElementById('photo').value;
        if (preview && photoUrl) {
            preview.src = photoUrl;
        }
    }
    document.getElementById("updateBtn").addEventListener("click", function(event) {
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
