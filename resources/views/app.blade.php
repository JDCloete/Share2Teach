<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
        <meta name="app:name" content="{{ config('app.name') }}">
        <meta name="app:subtitle" content="{{ config('app.subtitle') }}">
        <meta name="app:logo" content="{{ config('app.logo') }}">
        <meta name="app:menu_logo" content="{{ config('app.menu_logo') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

        <!-- Change favicon -->
        <link rel="icon" href="{{ asset('key.png') }}" type="image/png"/>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
<script>
    window.sessionData = @json(session('user_info'));
</script>
</html>
