<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    // List all borrow records
    public function index()
    {
        $borrows = Borrow::with(['book', 'user'])
            ->orderBy('issued_at', 'desc')
            ->get();

        return view('borrows.index', compact('borrows'));
    }

    // Show form to issue a book
    public function create()
    {
        $users = User::all();
        $books = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('borrows.create', compact('users', 'books'));
    }

    // Issue a book (reduce stock)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->stock <= 0) {
            return redirect()->back()
                ->with('error', 'Book is out of stock.')
                ->withInput();
        }

        Borrow::create([
            'user_id'     => $validated['user_id'],
            'book_id'     => $validated['book_id'],
            'issued_at'   => now(),
            'returned_at' => null,
        ]);

        $book->decrement('stock');

        $message = 'Book issued successfully.';
        if ($book->stock == 0) {
            $message .= ' This book is now out of stock.';
        }

        return redirect()->route('borrows.index')
            ->with('success', $message);
    }

    // Return a book (increase stock)
    public function returnBook(Borrow $borrow)
    {
        if ($borrow->returned_at) {
            return redirect()->back()
                ->with('error', 'This book is already returned.');
        }

        $borrow->returned_at = now();
        $borrow->save();

        $borrow->book->increment('stock');

        return redirect()->route('borrows.index')
            ->with('success', 'Book returned successfully.');
    }
}
