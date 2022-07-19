<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    @include('admin.layouts._css');
    <link rel="shortcut icon" href="{{asset('templates/admin/images/favicon.svg')}}" type="image/x-icon">
</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        @include('admin.layouts.sidebar')
    </div>
    <div id="main">
    @include('admin.layouts.header')

        <div class="page-heading">
            <h3>@yield('title')</h3>
        </div>
        <div class="page-content">
            @yield('content')
        </div>

        @include('admin.layouts.footer')
    </div>
</div>
    @include('admin.layouts._script')
</body>

</html>
