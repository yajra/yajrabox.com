<div class="w-full lg:w-40 lg:pl-12">
    <div>
        <label class="text-gray-600 text-xs tracking-widest uppercase"
               for="version-switcher">Version</label>
        <div x-data
             class="relative w-full bg-white transition-all duration-500 focus-within:border-gray-600">
            <select
                    id="version-switcher"
                    aria-label="Laravel version"
                    class="appearance-none flex-1 w-full px-0 py-1 placeholder-gray-900 tracking-wide bg-white focus:outline-none"
                    @change="window.location = $event.target.value"
            >
                @foreach ($versions as $key => $display)
                    <option {{ $currentVersion == $key ? 'selected' : '' }} value="{{ url('docs/'.$package.'/'.$key.$currentSection) }}">{{ $display }}</option>
                @endforeach
            </select>
            <img class="absolute inset-y-0 right-0 mt-2.5 w-2.5 h-2.5 text-gray-900 pointer-events-none"
                 id="docs_search__version_arrow" src="{{ asset('img/icons/drop_arrow.min.svg') }}" alt="">
            <img class="absolute inset-y-0 right-0 mt-2.5 w-2.5 h-2.5 text-gray-900 pointer-events-none"
                 id="docs_search__version_arrow_dark" src="{{ asset('img/icons/drop_arrow.dark.min.svg') }}"
                 alt="">
        </div>
    </div>
</div>