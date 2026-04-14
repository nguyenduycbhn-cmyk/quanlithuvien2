<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { margin:0; font-family: Arial; }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            position: fixed;
        }

        .sidebar h4 { padding: 20px; }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .active {
            background: #34495e;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>📚 Library</h4>

    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        📊 Dashboard
    </a>

    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
        📚 Quản lý sách
    </a>

    <a href="/borrow" class="{{ request()->is('borrow*') ? 'active' : '' }}">
        📖 Mượn trả
    </a>

    <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">
        👤 Thành viên
    </a>
</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

</body>
</html>