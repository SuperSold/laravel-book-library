@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Borrow / Return</h2>
    <a href="{{ route('borrows.create') }}" class="btn btn-primary">Issue Book</a>
</div>

@if ($borrows->isEmpty())
    <p>No borrow records yet.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Book</th>
            <th>Issued At</th>
            <th>Returned At</th>
            <th style="width: 150px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($borrows as $borrow)
            <tr>
                <td>{{ $borrow->user->name }}</td>
                <td>{{ $borrow->book->title }}</td>
                <td>{{ $borrow->issued_at }}</td>
                <td>{{ $borrow->returned_at ?? '-' }}</td>
                <td>
                    @if (!$borrow->returned_at)
                        <form action="{{ route('borrows.return', $borrow) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success">Return</button>
                        </form>
                    @else
                        <span class="badge bg-secondary">Completed</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
