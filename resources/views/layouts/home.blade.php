<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.header-css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('interno.navbar')
        @include('interno.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('interno.footer')
    </div>
</body>
@include('layouts.footer-scripts')

</html>