@extends('layouts.app')

@section('content')
<h2>Add Book</h2>

<form action="{{ route('books.store') }}" method="POST">
    @include('books._form')
</form>
@endsection
