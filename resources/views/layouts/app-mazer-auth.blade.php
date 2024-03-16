<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.head')
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>


<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    @yield('content')

    @include('layouts.partials.scripts')
</body>

</html>
