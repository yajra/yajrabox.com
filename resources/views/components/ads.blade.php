@props(['adSlot', 'publisher' => 'ca-pub-2399525660597307', 'type' => 'auto'])

@production
    <div class="ads-for-server-maintenance" {{ $attributes->exceptProps(['adSlot', 'publisher', 'type']) }}>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="{{ $publisher }}"
             data-ad-slot="{{ $adSlot }}"
             data-ad-format="{{ $type }}"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endproduction