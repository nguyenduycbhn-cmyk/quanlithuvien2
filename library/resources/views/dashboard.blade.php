<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div style="display:flex;">

<!-- SIDEBAR -->
<div style="width:250px;background:#2c3e50;color:white;height:100vh;">
    <h4 style="padding:20px;">📚 Library</h4>

    <a href="/dashboard" style="display:block;padding:10px;color:white;">
        📊 Dashboard
    </a>

    <a href="/" style="display:block;padding:10px;color:white;">
        📚 Quản lý sách
    </a>

    <a href="/borrow" style="display:block;padding:10px;color:white;">
        📖 Mượn trả
    </a>

    <!-- 🔥 THÊM NGAY ĐÂY -->
    <a href="/users" style="display:block;padding:10px;color:white;">
        👤 Thành viên
    </a>

</div>

<!-- CONTENT -->
<div style="flex:1;padding:20px;">

<h2>Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            Tổng sách: {{ $totalBooks }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white p-3">
            Đã mượn: {{ $totalBorrow }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white p-3">
            Đang mượn: {{ $borrowing }}
        </div>
    </div>
</div>

</div>
</div>

</body>
</html>