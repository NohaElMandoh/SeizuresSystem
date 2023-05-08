<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>الضبابطية الجمركية</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
	<meta name="description" content="nozha admin panel fully support rtl with complete dark mode css to use. ">
	<meta name=”robots” content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    @include('Dashboard.partials.styles')
    @yield('styles')
</head>

<body class="rtl persianumber">

    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">
    @include('Dashboard.partials.header')
    @include('Dashboard.partials.side_bar')
    <main class="bmd-layout-content">
            <div class="container-fluid ">
    @yield('content')
    </div>
        </main>
    </div>

    </div>


    @include('Dashboard.partials.scripts')
    @yield('scripts')
   

</body>

</html>