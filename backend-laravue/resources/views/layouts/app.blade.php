<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
</head>

<body>
    @include('includes.sidebar')
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        @include('includes.navbar')
        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /#right-panel -->

    {{-- Script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
</body>

</html>