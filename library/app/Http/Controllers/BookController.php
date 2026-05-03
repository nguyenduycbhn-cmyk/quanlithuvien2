<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BookController extends Controller
{
    // 📊 DASHBOARD
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalBorrow = Borrow::count();
        $borrowing = Borrow::whereNull('return_date')->count();

        $topBooks = Borrow::select('book_name')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('book_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topUsers = Borrow::select('user_name')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('user_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalBorrow',
            'borrowing',
            'topBooks',
            'topUsers'
        ));
    }

    // 📚 LIST + SEARCH
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $books = Book::when($keyword, function ($q) use ($keyword) {
            $q->where('title', 'like', "%$keyword%")
              ->orWhere('author', 'like', "%$keyword%");
        })
        ->latest()
        ->paginate(5);

        return view('books.index', compact('books', 'keyword'));
    }

    // ➕ CREATE FORM (🔥 FIX LỖI CREATE)
    public function create()
    {
        return view('books.create');
    }

    // 💾 STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'publisher' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $data = $request->only([
            'title',
            'author',
            'category',
            'publisher',
            'quantity',
            'price',
            'description'
        ]);

        // 📷 upload image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Thêm sách thành công!');
    }

    // ✏️ EDIT
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->only([
            'title',
            'author',
            'category',
            'publisher',
            'quantity',
            'price',
            'description'
        ]);

        if ($request->hasFile('image')) {
            if ($book->image && file_exists(public_path('uploads/'.$book->image))) {
                unlink(public_path('uploads/'.$book->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Cập nhật thành công!');
    }

    // ❌ DELETE
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image && file_exists(public_path('uploads/'.$book->image))) {
            unlink(public_path('uploads/'.$book->image));
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Đã xóa!');
    }
}