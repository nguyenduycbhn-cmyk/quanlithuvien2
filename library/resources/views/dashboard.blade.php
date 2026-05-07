<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body{
            margin:0;
            background:#f4f6f9;
            font-family:Arial, sans-serif;
        }

        .sidebar{
            width:250px;
            height:100vh;
            background:#2c3e50;
            position:fixed;
            overflow:auto;
        }

        .sidebar h4{
            padding:20px;
            color:white;
            border-bottom:1px solid rgba(255,255,255,0.1);
        }

        .sidebar a{
            display:block;
            padding:15px 20px;
            color:white;
            text-decoration:none;
            transition:0.3s;
        }

        .sidebar a:hover{
            background:#34495e;
        }

        .content{
            margin-left:250px;
            padding:20px;
        }

        .card-box{
            border:none;
            border-radius:12px;
            padding:20px;
            color:white;
            font-size:20px;
            font-weight:bold;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .table-card{
            border:none;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        @media(max-width:768px){

            .sidebar{
                width:100%;
                height:auto;
                position:relative;
            }

            .content{
                margin-left:0;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h4>📚 Quản lý thư viện</h4>

    <a href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('books.index') }}">
        <i class="bi bi-book"></i> Quản lý sách
    </a>

    <a href="{{ route('borrows.index') }}">
        <i class="bi bi-journal-text"></i> Mượn trả
    </a>

    <a href="{{ route('users.index') }}">
        <i class="bi bi-people"></i> Thành viên
    </a>

</div>

<!-- CONTENT -->
<div class="content">

    <h2 class="mb-4">📊 Dashboard</h2>

    <!-- THỐNG KÊ -->
    <div class="row g-3">

        <div class="col-md-4">
            <div class="card-box bg-primary">
                <div>Tổng sách</div>
                <h2>{{ $totalBooks ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box bg-warning">
                <div>Đã mượn</div>
                <h2>{{ $totalBorrow ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box bg-danger">
                <div>Đang mượn</div>
                <h2>{{ $borrowing ?? 0 }}</h2>
            </div>
        </div>

    </div>

    <!-- TOP SÁCH -->
    <div class="card table-card mt-4">

        <div class="card-header bg-primary text-white">
            📚 Top sách mượn nhiều
        </div>

        <div class="card-body">

            @if(isset($topBooks) && count($topBooks) > 0)

                <ul class="list-group">

                    @foreach($topBooks as $book)

                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            {{ $book->book_name }}

                            <span class="badge bg-primary rounded-pill">
                                {{ $book->total }}
                            </span>

                        </li>

                    @endforeach

                </ul>

            @else

                <p>Chưa có dữ liệu.</p>

            @endif

        </div>
    </div>

    <!-- TOP USER -->
    <div class="card table-card mt-4">

        <div class="card-header bg-warning text-dark">
            👤 Thành viên mượn nhiều nhất
        </div>

        <div class="card-body">

            @if(isset($topUsers) && count($topUsers) > 0)

                <ul class="list-group">

                    @foreach($topUsers as $user)

                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            {{ $user->user_name }}

                            <span class="badge bg-warning text-dark rounded-pill">
                                {{ $user->total }}
                            </span>

                        </li>

                    @endforeach

                </ul>

            @else

                <p>Chưa có dữ liệu.</p>

            @endif

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>