@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm Thành Viên</h2>
    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Họ Tên</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh</label>
            <input type="date" class="form-control" name="birth_date">
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính</label>
            <select name="gender" class="form-control">
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" class="form-control" name="photo">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection