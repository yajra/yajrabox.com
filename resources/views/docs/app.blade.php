<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ins2wgm.css">

    <!-- Scripts -->
    @vite(['resources/css/docs.css', 'resources/js/docs.js'])

    <!-- Styles -->
    @livewireStyles

    @php
        $routesThatAreAlwaysLightMode = collect([
            'marketing',
            'team',
        ])
    @endphp

    <script>
        const alwaysLightMode = {{ ($routesThatAreAlwaysLightMode->contains(request()->route()->getName())) ? 'true' : 'false' }};
    </script>

    @include('partials.theme')

    @production
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2399525660597307"
            crossorigin="anonymous"></script>
    @endproduction
</head>
<body
        x-data="{
        navIsOpen: false,
        searchIsOpen: false,
        search: '',
    }"
        class="language-php h-full w-full font-sans text-gray-900 antialiased dark:bg-dark-700"
>

@yield('content')

@include('partials.footer')

<x-search-modal/>

<script>
    var algolia_app_id = '{{ config('algolia.connections.main.id', false) }}';
    var algolia_search_key = '{{ config('algolia.connections.main.search_key', false) }}';
    var version = '{{ $currentVersion ?? DEFAULT_VERSION }}';
    var package = '{{ package_to_title($package ?? DEFAULT_PACKAGE) }}';
</script>

@include('partials.analytics')
</body>
</html>
