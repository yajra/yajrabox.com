@php
    $is_docs_page = request()->is('docs/*');
@endphp

<footer class="relative pt-12 {{ $is_docs_page ? 'dark:bg-dark-700' : '' }}">
    <div class="max-w-screen-2xl mx-auto w-full {{ $is_docs_page ? 'px-8' : 'px-5' }}">
        <div class="mt-6 grid grid-cols-12 md:gap-x-8 gap-y-12 sm:mt-12">
            <div class="col-span-12 lg:col-span-4">
                <p class="max-w-sm text-xs text-gray-700 sm:text-sm {{ $is_docs_page ? 'dark:text-gray-500' : '' }}">
                    Yajra is a software developer and a Laravel enthusiast. He is the author of many open source projects and a contributor to the Laravel community.
                </p>
                <ul class="mt-6 flex items-center space-x-3">
                    <li>
                        <a href="https://twitter.com/aqangeles">
                            <img id="footer__twitter_dark" class="{{ $is_docs_page ? 'hidden dark:inline-block' : 'hidden' }} w-6 h-6" src="{{ asset('img/social/twitter.dark.min.svg') }}" alt="Twitter" width="24" height="20" loading="lazy">
                            <img id="footer__twitter" class="{{ $is_docs_page ? 'inline-block dark:hidden' : 'inline-block' }} w-6 h-6" src="{{ asset('img/social/twitter.min.svg') }}" alt="Twitter" width="24" height="20" loading="lazy">
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/yajra">
                            <img id="footer__github_dark" class="{{ $is_docs_page ? 'hidden dark:inline-block' : 'hidden' }} w-6 h-6" src="{{ asset('img/social/github.dark.min.svg') }}" alt="GitHub" width="24" height="24" loading="lazy">
                            <img id="footer__github" class="{{ $is_docs_page ? 'inline-block dark:hidden' : 'inline-block' }} w-6 h-6" src="{{ asset('img/social/github.min.svg') }}" alt="GitHub" width="24" height="24" loading="lazy">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t pt-6 pb-16 border-gray-200 {{ $is_docs_page ? 'dark:border-dark-500' : '' }}">
            <p class="text-xs text-gray-700 {{ $is_docs_page ? 'dark:text-gray-400' : '' }}">
                {{ config('app.name') }} Copyright &copy; {{ now()->format('Y') }}.
            </p>
            <p class="mt-6 text-xs text-gray-700 {{ $is_docs_page ? 'dark:text-gray-400' : '' }}">
                Code highlighting provided by <a href="https://torchlight.dev">Torchlight</a>
            </p>
        </div>
    </div>
</footer>
