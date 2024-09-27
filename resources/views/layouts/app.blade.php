<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Document Management')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('pages.homepage') }}">Home</a></li>
            <li><a href="{{ route('documents.index') }}">Documents</a></li>
        </ul>
    </nav>
</header>

<main>
    @yield('content')
</main>
</body>
</html>
