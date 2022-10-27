<div id="main-content" class="mb-10">
    @isset($editRepoLink)
        {{ $editRepoLink }}
    @endif

    {{ $slot }}
</div>
