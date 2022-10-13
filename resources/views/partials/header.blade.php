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
                    <img class="sm:block" src="{{ asset('assets/img/yajrabox-lg.png') }}" alt="{{ config('app.name') }}" width="114"
                         height="29">
                </a>
            </div>
            <ul class="relative hidden lg:flex lg:items-center lg:justify-center lg:gap-6 xl:gap-10">
{{--                <li><a href="#">Support</a></li>--}}
            </ul>
            <div class="flex-1 flex items-center justify-end">
                <x-button.secondary href="https://github.com/yajra" class="hidden lg:ml-4 lg:inline-flex">Github Profile</x-button.secondary>
                <button
                        class="ml-2 relative w-10 h-10 inline-flex items-center justify-center p-2 text-gray-700 lg:hidden"
                        aria-label="Toggle Menu"
                        @click.prevent="navIsOpen = !navIsOpen"
                >
                    <svg x-show="! navIsOpen" class="w-6" viewBox="0 0 28 12" fill="none" xmlns="http://www.w3.org/2000/svg"><line y1="1" x2="28" y2="1" stroke="currentColor" stroke-width="2"/><line y1="11" x2="28" y2="11" stroke="currentColor" stroke-width="2"/></svg>
                    <svg x-show="navIsOpen" x-cloak class="absolute inset-0 mt-2.5 ml-2.5 w-5" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><rect y="1.41406" width="2" height="24" transform="rotate(-45 0 1.41406)" fill="currentColor"/><rect width="2" height="24" transform="matrix(0.707107 0.707107 0.707107 -0.707107 0.192383 16.9707)" fill="currentColor"/></svg>
                </button>
            </div>
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
                    <li><a class="block w-full py-2" href="https://github.com/yajra">Github Profile</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
