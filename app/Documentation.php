<?php

namespace App;

use App\Markdown\GithubFlavoredMarkdownConverter;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use League\CommonMark\Output\RenderedContentInterface;

class Documentation
{
    public function __construct(
        protected Filesystem $files,
        protected Cache $cache
    ) {}

    /**
     * Get the publicly available versions of the documentation
     */
    public static function getDefaultVersion(string $package): string
    {
        return Config::string('docs.packages.'.$package.'.default', DEFAULT_VERSION);
    }

    /**
     * Get the documentation index page.
     */
    public function getIndex(string $package, string $version): string
    {
        return $this->cache->remember($package.'.docs.'.$version.'.index', 5,
            function () use ($package, $version) {
                $path = $this->getBasePath($package, $version).'/documentation.md';

                if (! $this->files->exists($path)) {
                    return '';
                }

                $content = file_get_contents($path);
                if (! $content) {
                    return '';
                }

                $content = $this->replaceLinks($package, $version, $content);

                return $this->convertToMarkdown($content);
            }
        );
    }

    /**
     * Get base path of the package docs.
     */
    protected function getBasePath(string $package, string $version): string
    {
        return resource_path('docs/'.$package.'/'.$version);
    }

    /**
     * Check if documentation exists for the given package.
     */
    public static function exists(string $package): bool
    {
        return (bool) config('docs.packages.'.$package);
    }

    /**
     * Replace the version place-holder in links.
     */
    public static function replaceLinks(string $package, string $version, string $content): string
    {
        $content = str_replace('{{package}}', $package, $content);

        return str_replace('{{version}}', $version, $content);
    }

    public function convertToMarkdown(string $content): RenderedContentInterface
    {
        return (new GithubFlavoredMarkdownConverter)->convert($content);
    }

    /**
     * Get the array based index representation of the documentation.
     */
    public function indexArray(string $package, string $version): array
    {
        return $this->cache->remember('docs.{'.$package.':'.$version.'}.index', CarbonInterval::hour(1),
            function () use ($package, $version) {
                $path = resource_path("docs/$package/$version/documentation.md");

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
                                    'title' => $page['title'] ?? Config::string('app.name'),
                                    'sections' => collect($section['fragments'])
                                        ->combine($section['titles'])
                                        ->map(fn ($title) => ['title' => $title]),
                                ],
                            ];
                        }),
                ];
            });
    }

    /**
     * Get the given documentation page.
     */
    public function get(string $package, string $version, string $page): string
    {
        return $this->cache->remember($package.'.docs.'.$version.'.'.$page, 5,
            function () use ($package, $version, $page) {
                $path = $this->getBasePath($package, $version).'/'.$page.'.md';

                if (! $this->files->exists($path)) {
                    return '';
                }

                $content = file_get_contents($path);
                if (! $content) {
                    return '';
                }

                $content = $this->replaceLinks($package, $version, $content);

                return $this->convertToMarkdown($content);
            }
        );
    }

    /**
     * Determine which versions a page exists in.
     */
    public function versionsContainingPage(string $package, string $page): Collection
    {
        return collect(static::getDocVersions($package))
            ->filter(function ($version) use ($package, $page) {
                return $this->pageExists($package, $version, $page);
            });
    }

    /**
     * Get the publicly available versions of the documentation
     */
    public static function getDocVersions(string $package): array
    {
        return Config::array('docs.packages.'.$package.'.versions', []);
    }

    /**
     * Check if the given section exists.
     */
    public function pageExists(string $package, string $version, string $page): bool
    {
        $path = resource_path("docs/$package/$version/$page.md");

        return $this->files->exists($path);
    }

    public static function getRepositoryLink(string $package, string $version, string $sectionPage): string
    {
        $gitBasePath = 'https://github.com/yajra';

        return $gitBasePath.'/'.$package.'-docs/edit/'.$version.'/'.$sectionPage.'.md';
    }
}
