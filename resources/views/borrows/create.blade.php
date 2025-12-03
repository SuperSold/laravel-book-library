@extends('layouts.app')

@section('content')
<h2>Issue Book</h2>

<form action="{{ route('borrows.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">User</label>
        <select name="user_id" class="form-select">
            <option value="">-- Select User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
        @error('user_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Book</label>
        <select name="book_id" class="form-select">
            <option value="">-- Select Book --</option>
            @foreach ($books as $book)
                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                    {{ $book->title }} (Stock: {{ $book->stock }})
                </option>
            @endforeach
        </select>
        @error('book_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">Issue</button>
    <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
