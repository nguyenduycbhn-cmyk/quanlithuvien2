<!DOCTYPE html>
<html>
<head>
    <title>Sửa thành viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }
        .card { border-radius: 12px; }
    </style>
</head>
<body>

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-warning text-white">
    <h4><i class="bi bi-pencil-square"></i> Sửa thành viên</h4>
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

<form method="POST" action="{{ route('users.update', $user->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label class="form-label">👤 Họ và tên</label>
    <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên" value="{{ $user->name }}" required>
</div>

<div class="mb-3">
    <label class="form-label">📧 Email</label>
    <input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email" value="{{ $user->email }}" required>
</div>

<div class="mb-3">
    <label class="form-label">📞 Số điện thoại</label>
    <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{ $user->phone }}">
</div>

<!-- BUTTON -->
<div class="d-flex justify-content-between">
    <a href="/users" class="btn btn-secondary">
        ← Quay lại
    </a>

    <button type="submit" class="btn btn-warning">
        <i class="bi bi-check-circle"></i> Cập nhật
    </button>
</div>

</form>

</div>
</div>

</div>

</body>
</html>