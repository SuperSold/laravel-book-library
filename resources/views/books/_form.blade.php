@csrf

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $book->title ?? '') }}">
    @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Author</label>
    <input type="text" name="author" class="form-control"
           value="{{ old('author', $book->author ?? '') }}">
    @error('author') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="book_category_id" class="form-select">
        <option value="">-- Select Category --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('book_category_id', $book->book_category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('book_category_id') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="text" name="price" class="form-control"
           value="{{ old('price', $book->price ?? '') }}">
    @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" class="form-control"
           value="{{ old('stock', $book->stock ?? 0) }}">
    @error('stock') <div class="text-danger small">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary">Save</button>
<a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
