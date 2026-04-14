@extends('layouts.master')

@section('content')

<h2>📖 Mượn trả</h2>

<a href="/borrow/create" class="btn btn-primary mb-3">+ Mượn sách</a>

<table class="table table-bordered">
<tr>
    <th>Tên</th>
    <th>Sách</th>
    <th>Ngày mượn</th>
    <th>Ngày trả</th>
    <th></th>
</tr>

@foreach($borrows as $b)
<tr>
    <td>{{ $b->user_name }}</td>
    <td>{{ $b->book_name }}</td>
    <td>{{ $b->borrow_date }}</td>
    <td>{{ $b->return_date ?? 'Chưa trả' }}</td>
    <td>
        @if(!$b->return_date)
        <a href="/borrow/return/{{ $b->id }}" class="btn btn-success btn-sm">Trả</a>
        @endif
    </td>
</tr>
@endforeach

</table>

@endsection