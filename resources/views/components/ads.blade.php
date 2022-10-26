@props(['adSlot', 'publisher' => 'ca-pub-2399525660597307', 'type' => 'auto'])

@production
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="{{ $publisher }}"
         data-ad-slot="{{ $adSlot }}"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
@endproduction