@php
    $is_docs_page = request()->is('docs/*');
@endphp

<footer class="relative pt-12 {{ $is_docs_page ? 'dark:bg-dark-700' : '' }}">
    <div class="max-w-screen-2xl mx-auto w-full {{ $is_docs_page ? 'px-8' : 'px-5' }}">
        <div class="text-center text-xs text-gray-700 sm:text-sm {{ $is_docs_page ? 'dark:text-gray-500' : '' }}">
            <div class="flex justify-center">
                <div class="max-w-sm">
                    Arjay Angeles, also known as "<cite>yajra</cite>", is an open source software advocate and a Laravel enthusiast. He is the author of many open source projects and a contributor to the Laravel community.
                </div>
            </div>
            <div>
                <ul class="mt-6 flex justify-center items-center space-x-3">
                    <li>
                        <a href="https://twitter.com/aqangeles">
                            <img id="footer__twitter_dark" class="{{ $is_docs_page ? 'hidden' : 'hidden' }} w-6 h-6" src="{{ asset('img/social/twitter.dark.min.svg') }}" alt="Twitter" width="24" height="20" loading="lazy">
                            <img id="footer__twitter" class="{{ $is_docs_page ? 'inline-block' : 'inline-block' }} w-6 h-6" src="{{ asset('img/social/twitter.min.svg') }}" alt="Twitter" width="24" height="20" loading="lazy">
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/yajra">
                            <img id="footer__github_dark" class="{{ $is_docs_page ? 'hidden' : 'hidden' }} w-6 h-6" src="{{ asset('img/social/github.dark.min.svg') }}" alt="GitHub" width="24" height="24" loading="lazy">
                            <img id="footer__github" class="{{ $is_docs_page ? 'inline-block' : 'inline-block' }} w-6 h-6" src="{{ asset('img/social/github.min.svg') }}" alt="GitHub" width="24" height="24" loading="lazy">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t pt-6 pb-16 border-gray-200 {{ $is_docs_page ? 'dark:border-dark-500' : '' }}">
            <div class="flex justify-center">
                <p class="flex text-xs text-gray-700 max-w-sm {{ $is_docs_page ? 'dark:text-gray-400' : '' }}">
                    {{ config('app.name') }} Copyright &copy; {{ now()->format('Y') }}.
                </p>
            </div>

            <div class="mt-6 flex justify-center">
                <p class="flex text-xs text-gray-700 max-w-sm {{ $is_docs_page ? 'dark:text-gray-400' : '' }}">
                    Code highlighting provided by <a href="https://torchlight.dev">Torchlight</a>
                </p>
            </div>
        </div>
    </div>
</footer>
