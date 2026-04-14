<form method="POST" action="/update/{{ $book->id }}" enctype="multipart/form-data">
@csrf
<input name="title" value="{{ $book->title }}" class="form-control mb-2">
<input name="category" value="{{ $book->category }}" class="form-control mb-2">
<input name="author" value="{{ $book->author }}" class="form-control mb-2">
<input name="publisher" value="{{ $book->publisher }}" class="form-control mb-2">
<input name="quantity" value="{{ $book->quantity }}" class="form-control mb-2">
<input name="price" value="{{ $book->price }}" class="form-control mb-2">
<input type="file" name="image" class="form-control mb-2">
<button class="btn btn-primary">Cập nhật</button>
</form>