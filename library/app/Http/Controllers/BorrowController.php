<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;

class BorrowController extends Controller
{
    // 📋 Danh sách mượn
    public function index()
    {
        $borrows = Borrow::latest()->get();
        return view('borrow.index', compact('borrows'));
    }

    // ➕ Form mượn sách
    public function create()
    {
        $books = Book::where('quantity', '>', 0)->get();
        return view('borrow.create', compact('books'));
    }

    // 💾 Lưu mượn sách
    public function store(Request $request)
    {
        // ✅ Validate
        $request->validate([
            'user_name' => 'required',
            'book_name' => 'required',
            'borrow_date' => 'required|date'
        ]);

        // 🔍 Tìm sách
        $book = Book::where('title', $request->book_name)->first();

        // ❌ Nếu hết sách
        if (!$book || $book->quantity <= 0) {
            return back()->with('error', 'Sách đã hết!');
        }

        // ✅ Lưu mượn
        Borrow::create([
            'user_name' => $request->user_name,
            'book_name' => $request->book_name,
            'borrow_date' => $request->borrow_date,
            'return_date' => null
        ]);

        // 🔻 Giảm số lượng
        $book->quantity -= 1;
        $book->save();

        return redirect('/borrow')->with('success','Mượn sách thành công!');
    }

    // 🔄 Trả sách
    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);

        // ❗ Nếu chưa trả
        if (!$borrow->return_date) {

            // ✅ cập nhật ngày trả
            $borrow->return_date = now();
            $borrow->save();

            // 🔺 tăng lại số lượng sách
            $book = Book::where('title', $borrow->book_name)->first();
            if ($book) {
                $book->quantity += 1;
                $book->save();
            }

            return redirect('/borrow')->with('success','Đã trả sách!');
        }

        // ❗ nếu đã trả rồi
        return redirect('/borrow')->with('error','Sách này đã được trả trước đó!');
    }
}