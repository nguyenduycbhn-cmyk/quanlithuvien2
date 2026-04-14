<!DOCTYPE html>
<html>
<head>
    <title>Thêm thành viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

<h2>➕ Thêm thành viên</h2>

<form method="POST" action="/users/store">
@csrf

<div class="mb-3">
    <label>Tên</label>
    <input name="name" class="form-control">
</div>

<div class="mb-3">
    <label>Email</label>
    <input name="email" class="form-control">
</div>

<div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
</div>

<button class="btn btn-success">Thêm</button>

</form>

</div>

</body>
</html>