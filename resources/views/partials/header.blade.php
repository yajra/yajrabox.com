<header
        x-trap.inert.noscroll="navIsOpen"
        class="relative z-50 text-gray-700"
        @keydown.window.escape="navIsOpen = false"
        @click.away="navIsOpen = false"
>
    <div class="relative max-w-screen-2xl mx-auto w-full py-4 bg-white transition duration-200 lg:bg-transparent lg:py-6">
        <div class="max-w-screen-xl mx-auto px-5 flex items-center justify-between">
            <div class="flex-1">
                <a href="/" class="inline-flex items-center">
                    <img class="sm:block" src="{{ asset('img/logotype.min.svg') }}" alt="Laravel" width="114"
                         height="29">
                </a>
            </div>
            <ul class="relative hidden lg:flex lg:items-center lg:justify-center lg:gap-6 xl:gap-10">
                <li><a href="https://github.com/yajra">Github</a></li>
            </ul>
        </div>
    </div>

    <div
            x-show="navIsOpen"
            class="lg:hidden"
            x-transition:enter="duration-150"
            x-transition:leave="duration-100 ease-in"
            x-cloak
    >
        <nav
                x-show="navIsOpen"
                x-transition.opacity
                x-cloak
                class="fixed inset-0 w-full pt-[4.2rem] z-10 pointer-events-none"
        >
            <div class="relative h-full w-full py-8 px-5 bg-white pointer-events-auto overflow-y-auto">
                <ul>
                    <li><a class="block w-full py-2" href="https://forge.laravel.com">Forge</a></li>
                    <li class="flex sm:justify-center">
                        <x-button.secondary class="mt-3 w-full max-w-md" href="/docs">Documentation</x-button.secondary>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
