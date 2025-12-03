<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCate;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = BookCate::all();

        $query = Book::with('category');

        if ($request->filled('category_id')) {
            $query->where('book_category_id', $request->category_id);
        }

        $books = $query->orderBy('title')->get();

        return view('books.index', compact('books', 'categories'));
    }

    // Show create form
    public function create()
    {
        $categories = BookCate::all();
        return view('books.create', compact('categories'));
    }

    // Store new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'price'            => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'book_category_id' => 'required|exists:book_cate,id',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    // Show edit form
    public function edit(Book $book)
    {
        $categories = BookCate::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'price'            => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'book_category_id' => 'required|exists:book_cate,id',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
