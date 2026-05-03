<!DOCTYPE html>
<html>
<head>
    <title>Mượn sách</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-primary text-white">
    <h4><i class="bi bi-book"></i> Mượn sách</h4>
</div>

<div class="card-body">

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ url('/borrow/store') }}">
@csrf

<div class="row">

    <!-- 👤 USER -->
    <div class="col-md-6 mb-3">
        <label class="form-label">👤 Thành viên</label>
        <select name="user_name" class="form-select" required>
            <option value="">-- Chọn thành viên --</option>
            @foreach($users as $u)
                <option value="{{ $u->name }}">
                    {{ $u->name }} - {{ $u->email }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- 📚 BOOK -->
    <div class="col-md-6 mb-3">
        <label class="form-label">📖 Sách</label>
        <select name="book_name" class="form-select" required>
            <option value="">-- Chọn sách --</option>
            @foreach($books as $b)
                <option value="{{ $b->title }}">
                    {{ $b->title }} (Còn: {{ $b->quantity }})
                </option>
            @endforeach
        </select>
    </div>

</div>

<!-- 📅 DATE -->
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">📅 Ngày mượn</label>
        <input type="date" name="borrow_date" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">📅 Hạn trả (ngày)</label>
        <input type="date" name="due_date" class="form-control" required>
    </div>
</div>

<!-- BUTTON -->
<div class="d-flex justify-content-between">
    <a href="/borrow" class="btn btn-secondary">
        ← Quay lại
    </a>

    <button class="btn btn-success">
        <i class="bi bi-check-circle"></i> Xác nhận mượn
    </button>
</div>

</form>

</div>
</div>

</div>

</body>
</html>