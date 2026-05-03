@extends('layouts.master')

@section('content')

<h2>📖 Mượn trả</h2>

<a href="/borrow/create" class="btn btn-primary mb-3">+ Mượn sách</a>


<!-- Form tìm kiếm -->
<form method="GET" action="/borrow" class="mb-3 row g-2">
    <div class="col-auto">
        <input type="text" name="q" class="form-control" placeholder="Tìm kiếm tên, sách, ngày..." value="{{ request('q') }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
    </div>
</form>

<table class="table table-bordered">
<tr>
    <th>Tên</th>
    <th>Sách</th>
    <th>Ngày mượn</th>
    <th>Hạn trả</th>
    <th>Ngày trả</th>
    <th>Phạt</th>
    <th></th>
</tr>

@foreach($borrows as $b)
<tr>
    <td>{{ $b->user_name }}</td>
    <td>{{ $b->book_name }}</td>
    <td>{{ $b->borrow_date }}</td>
    <td>{{ $b->due_date ?? '-' }}</td>
    <td>
        @if($b->return_date)
            {{ $b->return_date }}
        @else
            <span class="text-danger">Chưa trả</span>
        @endif
    </td>
    <td>
        @if($b->penalty > 0)
            <span class="text-danger fw-bold">{{ number_format($b->penalty) }}đ</span>
        @else
            -
        @endif
    </td>
    <td>
        @if(!$b->return_date)
        <a href="/borrow/return/{{ $b->id }}" class="btn btn-success btn-sm">Trả</a>
        @endif
    </td>
</tr>
@endforeach

</table>

@endsection