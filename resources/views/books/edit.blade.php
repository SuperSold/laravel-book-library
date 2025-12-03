@extends('layouts.app')

@section('content')
<h2>Edit Book</h2>

<form action="{{ route('books.update', $book) }}" method="POST">
    @method('PUT')
    @include('books._form')
</form>
@endsection
