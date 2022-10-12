<div class="relative mt-8 flex items-center justify-end w-full h-10 lg:mt-0">
    <div class="flex-1 flex items-center">
        <button
                class="relative inline-flex items-center text-gray-800 transition-colors dark:text-gray-400 w-full"
                @click.prevent="$dispatch('toggle-search-modal')"
        >
            <svg class="w-5 h-5 text-gray-700 pointer-events-none transition-colors dark:text-gray-500"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span class="ml-3">Search</span>
        </button>
    </div>
</div>