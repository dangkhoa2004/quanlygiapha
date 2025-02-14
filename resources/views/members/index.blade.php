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
                <div class="flex justify-start my-4">
                    <a href="{{ route('members.create') }}">
                        <x-primary-button class="px-6 py-3 text-lg">
                            <i class="fas fa-user-plus mr-2"></i> {{ __('Thêm thành viên') }}
                        </x-primary-button>
                    </a>
                </div>
                <!-- Bảng danh sách thành viên -->
                <x-table-modal
                    :data="$members->map(function($member) {
                        return [
                            'STT'        => $member->id,
                            'Ảnh'        => $member->photo,
                            'Họ Tên'     => $member->name,
                            'Ngày Sinh'  => $member->birth_date,
                            'Giới Tính'  => $member->gender,
                                ];
                            })"
                    editRoute="members.edit"
                    deleteRoute="members.destroy" />

            </div>
        </div>
    </div>
</div>

@endsection