@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200">
        {{ __('Danh sách thành viên') }}
    </h2>
    <div class="container mx-auto p-6"><!-- Nút thêm thành viên -->
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
                'STT' => $member->id,
                'Họ Tên' => $member->name,
                'Ngày Sinh' => $member->birth_date,
                'Giới Tính' => $member->gender,
                'Ảnh' => $member->photo,
            ];
        })"
            editRoute="members.edit"
            deleteRoute="members.destroy" />
    </div>

</div>
@endsection