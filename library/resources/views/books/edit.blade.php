@extends('layouts.master')

@section('content')
<h2>Sửa sách</h2>
<form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $book->title }}"><br>
    <input type="text" name="author" value="{{ $book->author }}"><br>
    <textarea name="description">{{ $book->description }}</textarea><br>
    @if($book->image)
        <img src="{{ asset('uploads/' . $book->image) }}" width="120"><br>
    @endif
    <input type="file" name="image"><br>
    <button type="submit">Cập nhật</button>
</form>
@endsection