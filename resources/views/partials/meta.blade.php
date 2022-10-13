<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
@isset($title)
<title>{{ $title }} {{ isset($package) ? '- '. package_to_title($package) : '' }} - {{ config('app.name') }}</title>
@else
<title>{{ config('app.name') }}</title>
@endisset

@if (isset($canonical))
<link rel="canonical" href="{{ url($canonical) }}"/>
@endif

<!-- Primary Meta Tags -->
<meta name="title" content="YajraBox - Arjay Angeles aka yajra OSS projects">
<meta name="description" content="Arjay Angeles, also known as yajra, is an open source software advocate and a Laravel enthusiast. He is the author of many open source projects and a contributor to the Laravel community.">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ asset('/') }}">
<meta property="og:title" content="YajraBox - Arjay Angeles aka yajra OSS projects">
<meta property="og:description" content="Arjay Angeles, also known as yajra, is an open source software advocate and a Laravel enthusiast. He is the author of many open source projects and a contributor to the Laravel community.">
<meta property="og:image" content="{{ asset('img/og-image.jpg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ asset('/') }}">
<meta property="twitter:title" content="YajraBox - Arjay Angeles aka yajra OSS projects">
<meta property="twitter:description" content="Arjay Angeles, also known as yajra, is an open source software advocate and a Laravel enthusiast. He is the author of many open source projects and a contributor to the Laravel community.">
<meta property="twitter:image" content="{{ asset('img/og-image.jpg') }}">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ff2d20">
<link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}">
<meta name="msapplication-TileColor" content="#ff2d20">
<meta name="msapplication-config" content="{{ asset('img/favicon/browserconfig.xml') }}">
<meta name="theme-color" content="#ffffff">
<meta name="color-scheme" content="light">
