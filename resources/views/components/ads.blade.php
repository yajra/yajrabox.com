@props(['adSlot', 'publisher' => 'ca-pub-2399525660597307', 'type' => 'auto'])

@production
    <div class="ads-for-server-maintenance">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="{{ $publisher }}"
             data-ad-slot="{{ $adSlot }}"
             data-ad-format="{{ $type }}"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endproduction