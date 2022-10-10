<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.meta')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ins2wgm.css">

    <!-- Scripts -->
    @vite(['resources/css/docs.css', 'resources/js/app.js'])

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
</head>
<body
        x-data="{
        navIsOpen: false,
        searchIsOpen: false,
        search: '',
    }"
        class="language-php h-full w-full font-sans text-gray-900 antialiased"
>

@yield('content')

@include('partials.footer')

<x-search-modal/>

<script>
    var algolia_app_id = '{{ config('algolia.connections.main.id', false) }}';
    var algolia_search_key = '{{ config('algolia.connections.main.search_key', false) }}';
    var version = '{{ $currentVersion ?? DEFAULT_VERSION }}';
    var package = '{{ $package ?? DEFAULT_PACKAGE }}';
</script>

@production
    <script>
        var _gaq = [['_setAccount', 'UA-23865777-1'], ['_trackPageview']];
        (function (d, t) {
            var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
            g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g, s)
        }(document, 'script'));
    </script>
@endproduction
</body>
</html>
