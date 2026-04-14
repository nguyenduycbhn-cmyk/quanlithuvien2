<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BookController extends Controller
{
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalBorrow = Borrow::count();
        $borrowing = Borrow::whereNull('return_date')->count();

        return view('dashboard', compact('totalBooks','totalBorrow','borrowing'));
    }

    public function index(Request $request)
    {
        $q = $request->q;

        $books = Book::when($q, function ($query) use ($q) {
            return $query->where('title', 'like', "%$q%");
        })->paginate(5);

        return view('books.index', compact('books', 'q'));
    }

    public function create()
    {
        return view('books.create');
    }

    // 🔥 SỬA Ở ĐÂY
    public function store(Request $request)
    {
        // ✅ Validate dữ liệu
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $data = $request->all();

        // ✅ Upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['image'] = $name;
        }

        // ✅ Lưu vào DB
        Book::create($data);

        // ✅ Thông báo
        return redirect('/')->with('success','Thêm sách thành công!');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        // validate luôn khi sửa
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['image'] = $name;
        }

        $book->update($data);

        return redirect('/')->with('success','Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return redirect('/')->with('success','Xóa thành công!');
    }
}