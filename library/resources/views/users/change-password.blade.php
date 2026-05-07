@extends('layouts.master')

@section('content')

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-primary text-white">
    <h4><i class="bi bi-key"></i> Đổi mật khẩu</h4>
</div>

<div class="card-body">

{{-- ✅ THÔNG BÁO --}}
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- ✅ VALIDATE --}}
@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('users.change-password.post') }}">
@csrf

<div class="mb-3">
    <label class="form-label">🔒 Mật khẩu hiện tại</label>
    <input type="password" name="current_password" class="form-control" placeholder="Nhập mật khẩu hiện tại" required>
</div>

<div class="mb-3">
    <label class="form-label">🔑 Mật khẩu mới</label>
    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
</div>

<div class="mb-3">
    <label class="form-label">🔄 Xác nhận mật khẩu mới</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
</div>

<!-- BUTTON -->
<div class="d-flex justify-content-between">
    <a href="/users" class="btn btn-secondary">
        ← Quay lại
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-circle"></i> Đổi mật khẩu
    </button>
</div>

</form>

</div>
</div>

</div>

@endsection