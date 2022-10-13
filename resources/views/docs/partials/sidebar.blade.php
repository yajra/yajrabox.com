<aside class="hidden fixed top-0 bottom-0 left-0 z-20 h-full w-16 bg-gradient-to-b from-gray-100 to-white transition-all duration-300 overflow-hidden lg:sticky lg:w-80 lg:shrink-0 lg:flex lg:flex-col lg:justify-end lg:items-end 2xl:max-w-lg 2xl:w-full dark:from-dark-800 dark:to-dark-700">
    <div class="relative min-h-0 flex-1 flex flex-col xl:w-80">
        <a href="/" class="flex items-center py-8 px-4 lg:px-8 xl:px-16">
            <img
                    src="{{ asset('img/logo.min.svg') }}"
                    alt="{{ config('app.name') }}"
                    class="hidden lg:block mr-2"
                    width="114"
                    height="29"
            >
            <h1 class="font-bold dark:text-gray-400">{{ package_to_title($package) }}</h1>
        </a>

        <div class="overflow-y-auto overflow-x-hidden px-4 lg:overflow-hidden lg:px-8 xl:px-16">
            <nav id="indexed-nav" class="hidden lg:block lg:mt-4">
                <div class="docs_sidebar">
                    {!! $index !!}

                    <x-ads ad-slot="5965792075" />
                </div>
            </nav>
        </div>
    </div>
</aside>
