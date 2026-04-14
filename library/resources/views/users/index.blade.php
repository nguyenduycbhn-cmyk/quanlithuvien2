@extends('layouts.master')

@section('content')

<h2>👤 Danh sách thành viên</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<a href="/users/create" class="btn btn-primary mb-3">+ Thêm thành viên</a>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Tên</th>
    <th>Email</th>
    <th></th>
</tr>

@foreach($users as $u)
<tr>
    <td>{{ $u->id }}</td>
    <td>{{ $u->name }}</td>
    <td>{{ $u->email }}</td>
    <td>
        <a href="/users/delete/{{ $u->id }}" class="btn btn-danger btn-sm">Xóa</a>
    </td>
</tr>
@endforeach

</table>

@endsection