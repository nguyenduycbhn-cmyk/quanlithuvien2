<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;

class BorrowController extends Controller
{
    // 📋 Danh sách mượn + tìm kiếm
    public function index(Request $request)
    {
        $query = Borrow::query();

        if ($request->q) {
            $search = $request->q;

            $query->where(function ($q) use ($search) {
                $q->where('user_name', 'like', "%$search%")
                  ->orWhere('book_name', 'like', "%$search%")
                  ->orWhere('borrow_date', 'like', "%$search%")
                  ->orWhere('return_date', 'like', "%$search%");
            });
        }

        $borrows = $query->latest()->paginate(10);

        return view('borrow.index', compact('borrows'));
    }

    // ➕ FORM MƯỢN (🔥 FIX Ở ĐÂY)
    public function create()
    {
        $books = Book::where('quantity', '>', 0)->get();
        $users = User::all(); // 🔥 thêm dòng này

        return view('borrow.create', compact('books', 'users'));
    }

    // 💾 LƯU MƯỢN
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'book_name' => 'required',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date'
        ]);

        $book = Book::where('title', $request->book_name)->first();

        if (!$book || $book->quantity <= 0) {
            return back()->with('error', '❌ Sách đã hết!');
        }

        Borrow::create([
            'user_name' => $request->user_name,
            'book_name' => $request->book_name,
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'return_date' => null
        ]);

        // 🔻 giảm số lượng
        $book->decrement('quantity');

        return redirect('/borrow')->with('success', '✅ Mượn sách thành công!');
    }

    // 🔄 TRẢ SÁCH
    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);

        if (is_null($borrow->return_date)) {

            $returnDate = now();
            $penalty = 0;

            // Tính phạt nếu trả muộn
            if ($borrow->due_date && $returnDate->gt($borrow->due_date)) {
                $daysLate = $returnDate->diffInDays($borrow->due_date);
                $penalty = $daysLate * 5000; // 5000đ/ngày
            }

            $borrow->update([
                'return_date' => $returnDate,
                'penalty' => $penalty
            ]);

            $book = Book::where('title', $borrow->book_name)->first();

            if ($book) {
                $book->increment('quantity');
            }

            if ($penalty > 0) {
                return redirect('/borrow')->with('warning', "✅ Đã trả sách! Bị phạt " . number_format($penalty) . "đ (quá hạn)");
            }

            return redirect('/borrow')->with('success', '✅ Đã trả sách đúng hạn!');
        }

        return redirect('/borrow')->with('error', '❌ Sách đã được trả rồi!');
    }
}