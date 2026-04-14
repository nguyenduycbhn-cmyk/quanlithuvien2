<!DOCTYPE html>
<html>
<head>
    <title>Thêm sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

<h2>📚 Thêm sách mới</h2>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/store" enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label>📖 Tiêu đề</label>
    <input name="title" class="form-control" placeholder="Nhập tên sách">
</div>

<div class="mb-3">
    <label>📂 Danh mục</label>
    <input name="category" class="form-control" placeholder="Ví dụ: Văn học">
</div>

<div class="mb-3">
    <label>✍️ Tác giả</label>
    <input name="author" class="form-control" placeholder="Tên tác giả">
</div>

<div class="mb-3">
    <label>🏢 Nhà xuất bản</label>
    <input name="publisher" class="form-control">
</div>

<div class="mb-3">
    <label>📦 Số lượng</label>
    <input type="number" name="quantity" class="form-control">
</div>

<div class="mb-3">
    <label>💰 Giá</label>
    <input type="number" name="price" class="form-control">
</div>

<div class="mb-3">
    <label>🖼 Ảnh sách</label>
    <input type="file" name="image" class="form-control" onchange="previewImage(event)">
</div>

<div class="mb-3">
    <img id="preview" width="120" style="display:none;">
</div>

<button class="btn btn-success">💾 Lưu</button>
<a href="/" class="btn btn-secondary">← Quay lại</a>

</form>

</div>

<script>
function previewImage(event) {
    let img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>

</body>
</html>