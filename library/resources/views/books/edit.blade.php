@extends('layouts.master')

@section('content')

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-warning text-white">
    <h4><i class="bi bi-pencil-square"></i> Sửa sách</h4>
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

<form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-3">
    <label class="form-label">📖 Tiêu đề sách</label>
    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề sách" value="{{ $book->title }}" required>
</div>

<div class="mb-3">
    <label class="form-label">👤 Tác giả</label>
    <input type="text" name="author" class="form-control" placeholder="Nhập tên tác giả" value="{{ $book->author }}" required>
</div>

<div class="mb-3">
    <label class="form-label">📝 Mô tả</label>
    <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả sách">{{ $book->description }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">🖼️ Hình ảnh</label>
    @if($book->image)
        <div class="mb-2">
            <img src="{{ asset('uploads/' . $book->image) }}" width="120" class="img-thumbnail">
        </div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
    <small class="form-text text-muted">Chọn hình ảnh mới nếu muốn thay đổi (định dạng: JPG, PNG, GIF).</small>
</div>

<!-- BUTTON -->
<div class="d-flex justify-content-between">
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        ← Quay lại
    </a>

    <button type="submit" class="btn btn-warning">
        <i class="bi bi-check-circle"></i> Cập nhật sách
    </button>
</div>

</form>

</div>
</div>

</div>

@endsection