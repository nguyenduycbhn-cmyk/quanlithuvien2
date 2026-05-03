<!DOCTYPE html>
<html>
<head>
    <title>Thêm sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }
        .card { border-radius: 12px; }
    </style>
</head>
<body>

<div class="container mt-5">
<div class="card shadow p-4">

<h3 class="mb-4">📚 Thêm sách (Auto Form)</h3>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
@csrf

@php
$fields = [
    ['name' => 'title', 'label' => 'Tên sách', 'type' => 'text'],
    ['name' => 'author', 'label' => 'Tác giả', 'type' => 'text'],
    ['name' => 'category', 'label' => 'Danh mục', 'type' => 'text'],
    ['name' => 'publisher', 'label' => 'Nhà xuất bản', 'type' => 'text'],
    ['name' => 'quantity', 'label' => 'Số lượng', 'type' => 'number'],
];
@endphp

{{-- 🔥 AUTO INPUT --}}
@foreach($fields as $f)
<div class="mb-3">
    <label>{{ $f['label'] }}</label>
    <input 
        type="{{ $f['type'] }}" 
        name="{{ $f['name'] }}" 
        class="form-control"
        value="{{ old($f['name']) }}"
        required>
</div>
@endforeach

{{-- DESCRIPTION --}}
<div class="mb-3">
    <label>Mô tả</label>
    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
</div>

{{-- IMAGE --}}
<div class="mb-3">
    <label>Ảnh</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-success">➕ Thêm sách</button>
<a href="/" class="btn btn-secondary">← Quay lại</a>

</form>

</div>
</div>

</body>
</html>