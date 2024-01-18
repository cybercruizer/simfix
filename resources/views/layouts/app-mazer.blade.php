<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.partials.head')
<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @if (Auth::user()->role =='admin')
            @include('layouts.partials.sidebar-admin')
        @elseif (Auth::user()->role == 'guru')
            @include('layouts.partials.sidebar-guru')
        @endif

        <div id="main">
            @include('layouts.partials.header')
            @yield('content')

            @include('layouts.partials.footer')
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>
</html>
