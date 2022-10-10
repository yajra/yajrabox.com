<?php

namespace App;

use App\Markdown\GithubFlavoredMarkdownConverter;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use League\CommonMark\Output\RenderedContentInterface;

class Documentation
{
    /**
     * Create a new documentation instance.
     *
     * @param  Filesystem  $files
     * @param  Cache  $cache
     * @return void
     */
    public function __construct(
        protected Filesystem $files,
        protected Cache $cache
    ) {
    }

    /**
     * Get the publicly available versions of the documentation
     *
     * @param  string  $package
     * @return array
     */
    public static function getDocVersions(string $package): array
    {
        $versions = config('docs.versions');

        return $versions[$package];
    }

    /**
     * Get the documentation index page.
     *
     * @param  string  $package
     * @param  string  $version
     * @return string
     */
    public function getIndex(string $package, string $version): string
    {
        return $this->cache->remember($package.'.docs.'.$version.'.index', 5,
            function () use ($package, $version) {
                $path = $this->getBasePath($package).$version.'/documentation.md';

                $content = file_get_contents($path);

                if ($content) {
                    return $this->replaceLinks($package, $version, $this->convertToMarkdown($content));
                }

                return null;
            }
        );
    }

    /**
     * Get base path of the package docs.
     *
     * @param  string  $package
     * @return string
     */
    protected function getBasePath(string $package): string
    {
        $paths = config('docs.paths');

        if (app()->isLocal() && ! app()->runningInConsole()) {
            $paths = config('docs.local_paths');
        }

        return $paths[$package];
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $package
     * @param  string  $version
     * @param  string  $content
     * @return string
     */
    public static function replaceLinks(string $package, string $version, string $content): string
    {
        $content = str_replace('{{package}}', $package, $content);

        return str_replace('{{version}}', $version, $content);
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $package
     * @param  string  $version
     * @param  string  $page
     * @return string
     */
    public function get(string $package, string $version, string $page): string
    {
        return $this->cache->remember($package.'.docs.'.$version.'.'.$page, 5,
            function () use ($package, $version, $page) {
                $path = $this->getBasePath($package).$version.'/'.$page.'.md';
                $content = file_get_contents($path);

                if ($content) {
                    return $this->replaceLinks($package, $version, $this->convertToMarkdown($content));
                }

                return null;
            }
        );
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $package
     * @param  string  $version
     * @param  string  $page
     * @return bool
     */
    public function pageExists(string $package, string $version, string $page): bool
    {
        if (app()->isLocal()) {
            return true;
        }

        return $this->cache->remember($package.'.docs.'.$version.'.'.$page.'.exists', 5,
            function () use ($package, $version, $page) {
                $file = $this->getBasePath($package).$version.'/'.$page.'.md';

                $file_headers = @get_headers($file);

                return $file_headers[0] == 'HTTP/1.1 200 OK';
            }
        );
    }

    /**
     * @param  string  $content
     * @return \League\CommonMark\Output\RenderedContentInterface
     */
    function convertToMarkdown(string $content): RenderedContentInterface
    {
        return (new GithubFlavoredMarkdownConverter())->convert($content);
    }

    /**
     * Get the array based index representation of the documentation.
     *
     * @param  string  $package
     * @param  string  $version
     * @return array
     */
    public function indexArray(string $package, string $version): array
    {
        return $this->cache->remember('docs.{'.$package.':'.$version.'}.index', CarbonInterval::hour(1),
            function () use ($package, $version) {
                $path = base_path("resources/docs/$package/$version/documentation.md");

                if (! $this->files->exists($path)) {
                    return [];
                }

                return [
                    'pages' => collect(explode(PHP_EOL,
                        $this->replaceLinks($package, $version, $this->files->get($path))))
                        ->filter(fn ($line) => Str::contains($line, "/docs/$package/$version/"))
                        ->map(fn ($line) => resource_path(Str::of($line)->afterLast('(/')->before(')')
                                                             ->replace('{{version}}', $version)->append('.md')))
                        ->filter(fn ($path) => $this->files->exists($path))
                        ->mapWithKeys(function ($path) {
                            $contents = $this->files->get($path);

                            preg_match('/\# (?<title>[^\\n]+)/', $contents, $page);
                            preg_match_all('/<a name="(?<fragments>[^"]+)"><\\/a>\n#+ (?<titles>[^\\n]+)/', $contents,
                                $section);

                            return [
                                (string) Str::of($path)->afterLast('/')->before('.md') => [
                                    'title' => $page['title'],
                                    'sections' => collect($section['fragments'])
                                        ->combine($section['titles'])
                                        ->map(fn ($title) => ['title' => $title]),
                                ],
                            ];
                        }),
                ];
            });
    }

}
