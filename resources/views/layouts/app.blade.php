<!DOCTYPE html>
<html>
<head>
    <title>Book Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Book Library</a>
        <div>
            <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-light me-2">Books</a>
            <a href="{{ route('borrows.index') }}" class="btn btn-sm btn-outline-light">Borrow / Return</a>
        </div>
    </div>
</nav>

<div class="container">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
