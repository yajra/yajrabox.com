<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/ins2wgm.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/docs.css'])

    <!-- Styles -->
    @livewireStyles
</head>
<body x-data="{navIsOpen: false, searchIsOpen: false, search: ''}"
      class="language-php h-full w-full font-sans text-gray-900 antialiased"
>

<div class="absolute top-0 w-full">
    @include('partials.header')
</div>

<div class="relative overflow-hidden py-16 md:pt-48">
    <span class="hidden absolute bg-radial-gradient opacity-[.15] pointer-events-none lg:inline-flex right-[-20%] top-0 w-[640px] h-[640px]"></span>
    <div class="relative max-w-screen-xl mx-auto px-5 pb-24">

        <h1 class="text-4xl font-bold max-w-4xl mx-auto text-center md:text-5xl">Open Source Projects</h1>

        <div class="mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($projects as $project)
                <x-project :project="$project"/>
            @endforeach
        </div>
    </div>
</div>

@include('partials.footer')
@include('partials.analytics')
</body>
</html>