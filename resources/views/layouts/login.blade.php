<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.header-css')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>
</body>
@include('layouts.footer-scripts')

</html>