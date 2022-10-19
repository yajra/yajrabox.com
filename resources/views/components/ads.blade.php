@props(['adSlot', 'publisher' => 'ca-pub-2399525660597307', 'type' => 'auto'])

@production
    <div class="mt-4 px-3 py-2 border-dashed border-gray-200 border rounded-lg text-xs leading-loose text-gray-700 lg:block dark:border-gray-400 dark:text-gray-200" {{ $attributes->exceptProps(['adSlot', 'publisher', 'type']) }}>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2399525660597307"
                crossorigin="anonymous"></script>
        <!-- responsive-vertical -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-2399525660597307"
             data-ad-slot="{{ $adSlot }}"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endproduction