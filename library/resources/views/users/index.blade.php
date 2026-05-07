@extends('layouts.master')

@section('content')

<h2>👤 Danh sách thành viên</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<!-- Form tìm kiếm thành viên -->
<form method="GET" action="/users" class="mb-3 row g-2">
    <div class="col-auto">
        <input type="text" name="q" class="form-control" placeholder="Tìm kiếm tên, email..." value="{{ request('q') }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
    </div>
</form>

<a href="/users/create" class="btn btn-primary mb-3">+ Thêm thành viên</a>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Tên</th>
    <th>Email</th>
    <th>Điện thoại</th>
    <th></th>
</tr>

@foreach($users as $u)
<tr>
    <td>{{ $u->id }}</td>
    <td>{{ $u->name }}</td>
    <td>{{ $u->email }}</td>
    <td>{{ $u->phone ?? '-' }}</td>
    <td>
        <a href="{{ route('users.edit', $u->id) }}" class="btn btn-warning btn-sm">Sửa</a>
        <a href="/users/delete/{{ $u->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
    </td>
</tr>
@endforeach

</table>

@endsection