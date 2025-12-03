@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Books</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
</div>

<form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="category_id" class="form-select">
            <option value="">-- All Categories --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-secondary">Filter</button>
    </div>
</form>

@if ($books->isEmpty())
    <p>No books found.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th style="width: 150px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr @if($book->stock == 0) class="table-danger" @endif>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category?->name }}</td>
                <td>{{ number_format($book->price, 2) }}</td>
                <td>
                    {{ $book->stock }}
                    @if ($book->stock == 0)
                        <span class="badge bg-danger ms-2">Out of stock</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this book?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
