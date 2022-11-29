<div id="main-content" class="mb-10">
    {{ $slot }}

    @isset($editRepoLink)
        {{ $editRepoLink }}
    @endif
</div>
