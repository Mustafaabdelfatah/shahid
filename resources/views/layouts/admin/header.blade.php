<head>
    <meta charset="utf-8" />
    <title> {{ config('app.name') }} | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.ico')}}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>

    <!-- App css -->
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/admin/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    @else
        <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    @endif
    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--  -->
    <!-- Icons css -->
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    @livewireStyles
</head>
