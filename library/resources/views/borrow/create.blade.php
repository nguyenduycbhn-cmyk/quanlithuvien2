<!DOCTYPE html>
<html>
<head>
    <title>Mượn sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

<div class="card p-4 shadow">

<h2 class="mb-4">📚 Mượn sách</h2>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/borrow/store">
@csrf

<!-- 👤 CHỌN THÀNH VIÊN -->
<div class="mb-3">
    <label class="form-label">👤 Chọn thành viên</label>
    <select name="user_name" class="form-control" required>
        @foreach(\App\Models\User::all() as $u)
            <option value="{{ $u->name }}">
                {{ $u->name }} ({{ $u->email }})
            </option>
        @endforeach
    </select>
</div>

<!-- 📚 CHỌN SÁCH -->
<div class="mb-3">
    <label class="form-label">📖 Chọn sách</label>
    <select name="book_name" class="form-control" required>
        @foreach($books as $b)
        <option value="{{ $b->title }}">
            {{ $b->title }} (Còn: {{ $b->quantity }})
        </option>
        @endforeach
    </select>
</div>

<!-- 📅 NGÀY MƯỢN -->
<div class="mb-3">
    <label class="form-label">📅 Ngày mượn</label>
    <input type="date" name="borrow_date" class="form-control" required>
</div>

<!-- BUTTON -->
<button class="btn btn-success">📥 Mượn sách</button>
<a href="/borrow" class="btn btn-secondary">← Quay lại</a>

</form>

</div>

</div>

</body>
</html>