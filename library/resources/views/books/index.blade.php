@extends('layouts.master')

@section('title','Quản lý sách')

@section('content')

<a href="/create" class="btn btn-primary mb-3">+ Thêm sách</a>

<table class="table table-bordered table-hover">
<tr>
    <th>ID</th>
    <th>Ảnh</th>
    <th>Tiêu đề</th>
    <th>Danh mục</th>
    <th>Tác giả</th>
    <th>NXB</th>
    <th>Số lượng</th>
    <th>Giá</th>
    <th></th>
</tr>

@foreach($books as $b)
<tr>
    <td>{{ $b->id }}</td>
    <td>
        @if($b->image)
        <img src="{{ asset('uploads/'.$b->image) }}" width="50">
        @endif
    </td>
    <td>{{ $b->title }}</td>
    <td>{{ $b->category }}</td>
    <td>{{ $b->author }}</td>
    <td>{{ $b->publisher }}</td>
    <td>{{ $b->quantity }}</td>
    <td>{{ number_format($b->price) }}đ</td>
    <td>
        <a href="/edit/{{ $b->id }}" class="btn btn-warning btn-sm">Sửa</a>
        <a href="/delete/{{ $b->id }}" class="btn btn-danger btn-sm">Xóa</a>
    </td>
</tr>
@endforeach

</table>

{{ $books->links() }}

@endsection