@extends('layouts.master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-book"></i> 📚 Danh sách sách</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm sách
    </a>
</div>

<!-- 🔍 TÌM KIẾM -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('books.index') }}" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Tìm tên sách hoặc tác giả..."
                       value="{{ request('keyword') }}">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Tìm
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- 📚 DANH SÁCH SÁCH -->
<div class="row">
@forelse($books as $book)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="row g-0">
                <div class="col-4">
                    @if($book->image)
                        <img src="{{ asset('uploads/' . $book->image) }}" 
                             class="img-fluid rounded-start h-100" 
                             style="object-fit: cover;"
                             alt="{{ $book->title }}">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center h-100" 
                             style="min-height: 200px;">
                            <i class="bi bi-book fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                        <p class="card-text text-muted small mb-1">
                            <i class="bi bi-person"></i> {{ $book->author }}
                        </p>
                        <p class="card-text small">
                            <span class="badge bg-info">{{ $book->category }}</span>
                        </p>
                        <p class="card-text small text-truncate">{{ $book->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-{{ $book->quantity > 0 ? 'success' : 'danger' }}">
                                {{ $book->quantity }} cuốn
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between">
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil"></i> Sửa
                </a>
                <a href="{{ url('/books/'.$book->id.'/delete') }}" 
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Bạn có chắc muốn xóa?')">
                    <i class="bi bi-trash"></i> Xóa
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <i class="bi bi-inbox"></i> Chưa có sách nào!
        </div>
    </div>
@endforelse
</div>

<!-- PHÂN TRANG -->
{{ $books->appends(request()->query())->links() }}

@endsection