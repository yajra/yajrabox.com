<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@isset($title)
    <title>{{ $title }} {{ isset($package) ? '- '. package_to_title($package) : '' }} - {{ config('app.name') }}</title>
@else
    <title>{{ config('app.name') }}</title>
@endisset
<meta name="keywords" content="@yield('keywords', config('site.keywords'))"/>
<meta name="author" content="@yield('author', config('site.author'))"/>
<meta name="description" content="@yield('description', config('site.description'))"/>

<meta property="og:title" content="{{ config('app.name') }}"/>
<meta property="og:type" content="website"/>
<meta property="og:description" content="@yield('description', config('site.description'))"/>
<meta property="og:url" content="{{request()->url()}}"/>
<meta property="og:image" content="{{asset('themes/clean-blog/img/home-bg.jpg')}}"/>

@if (isset($canonical))
    <link rel="canonical" href="{{ url($canonical) }}"/>
@endif

@section('favicon')
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{ asset('assets/icons/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/icons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/icons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="color-scheme" content="light">
@show

