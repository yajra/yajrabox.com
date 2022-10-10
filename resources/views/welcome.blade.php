<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ins2wgm.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body x-data="{navIsOpen: false, searchIsOpen: false, search: ''}"
      class="language-php h-full w-full font-sans text-gray-900 antialiased"
>

<div class="absolute top-0 w-full">
    @include('partials.header')
</div>

<div>
    <section class="relative overflow-hidden pt-48 pb-20 lg:pt-48 xl:pt-56 xl:pb-28">
        <x-radial-blur class="left-[-20%] -top-24 w-[640px] h-[640px]" />
        <div class="relative max-w-screen-xl px-5 mx-auto">
            <div class="absolute -left-2 -translate-y-12 pointer-events-none md:left-[12%]">
                <x-cube />
            </div>
            <div class="absolute -right-2 -translate-y-20 pointer-events-none md:right-1/4">
                <x-cube :delay="2000" />
            </div>
            <div class="absolute bottom-0 right-6 -translate-y-20 pointer-events-none md:right-[12%]">
                <x-cube :delay="1000" />
            </div>
            <div class="relative">
                <h1 class="max-w-3xl mx-auto text-5xl font-bold text-center md:text-6xl lg:text-7xl">The PHP Framework <br class="hidden lg:inline"><span class="text-red-500">for Web Artisans</span></h1>
                <p class="mt-6 max-w-xl mx-auto text-center text-gray-700 text-md leading-relaxed md:mt-8 md:text-lg lg:mt-10">Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.</p>
                <div class="mt-6 max-w-sm mx-auto flex flex-col justify-center items-center gap-4 sm:flex-row md:mt-8 lg:mt-10">
                    <x-button.primary class="w-full sm:w-auto" href="/docs">
                        Get Started
                    </x-button.primary>
                    <x-button.secondary class="w-full sm:w-auto" href="https://laracasts.com" target="_blank">
                        Watch Laracasts
                    </x-button.secondary>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="relative overflow-hidden py-16 md:pt-48">
    <span class="hidden absolute bg-radial-gradient opacity-[.15] pointer-events-none lg:inline-flex right-[-20%] top-0 w-[640px] h-[640px]"></span>
    <div class="max-w-screen-xl w-full mx-auto px-5">
        <h1 class="text-4xl font-bold max-w-lg md:text-5xl">Open Source Projects</h1>
        @foreach($projects->chunk(3) as $chunks)
            <div class="mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($chunks as $project)
                    <div>
                        <a href="{{ route('docs.show-root-page', ['package' => $project['name']]) }}">
                            <h3 class="mt-5 text-xl font-bold">{{$project['name']}}</h3>
                        </a>

                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                            {{$project['description']}}
                        </p>

                        <div class="flex space-x-3 mt-2">
                            <a href="{{$project['html_url']}}" class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                </svg>
                                {{$project['stargazers_count']}}
                            </a>
                            <a href="{{$project['html_url']}}/issues" class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z"/>
                                </svg>
                                {{$project['open_issues']}}
                            </a>
                            <a href="{{$project['html_url']}}/network" class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                </svg>
                                {{$project['forks_count']}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

@include('partials.footer')

<script>
    var algolia_app_id = '{{ config('algolia.connections.main.id', false) }}';
    var algolia_search_key = '{{ config('algolia.connections.main.search_key', false) }}';
    var version = '{{ $currentVersion ?? DEFAULT_VERSION }}';
    var package = '{{ $package ?? DEFAULT_PACKAGE }}';
</script>

@production
    <script>
        var _gaq = [['_setAccount', 'UA-63183947-3'], ['_trackPageview']];
        (function (d, t) {
            var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
            g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g, s)
        }(document, 'script'));
    </script>
@endproduction
</body>
</html>
