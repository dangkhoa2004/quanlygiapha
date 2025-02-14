@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
                    {{ __('Thêm Thành Viên') }}
                </h2>
            </div>

            <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Họ và tên -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Họ và Tên')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Ngày sinh -->
                <div class="mb-4">
                    <x-input-label for="birth_date" :value="__('Ngày Sinh')" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" value="{{ old('birth_date') }}" required />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>

                <!-- Giới tính -->
                <div class="mb-4">
                    <x-input-label for="gender" :value="__('Giới Tính')" />
                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="feMale" {{ old('gender') == 'feMale' ? 'selected' : '' }}>Nữ</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <!-- Ảnh đại diện -->
                <div class="mb-4">
                    <x-input-label for="photo" :value="__('Ảnh Đại Diện')" />
                    <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" accept="image/*" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>

                <!-- Nút lưu & Trở về -->
                <div class="flex justify-end space-x-3 mt-4">
                    <a href="{{ route('members.index') }}">
                        <x-secondary-button>{{ __('Trở về') }}</x-secondary-button>
                    </a>
                    <x-primary-button>{{ __('Lưu Thành Viên') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
