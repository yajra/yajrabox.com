<div id="main-content">
    @isset($editRepoLink)
        {{ $editRepoLink }}
    @endif
    {{ $slot }}
</div>
