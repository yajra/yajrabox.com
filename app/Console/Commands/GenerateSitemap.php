<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $appUrl = (string) config('app.url');

        SitemapGenerator::create($appUrl)
            ->shouldCrawl(function (UriInterface $url) {
                // Crawl everything without "docs" in the path, as we'll crawl the docs separately...
                return ! Str::contains($url->getPath(), 'docs');
            })
            ->hasCrawled(function (Url $url) {
                if ($url->segment(1) === 'team') {
                    $url->setPriority(0.5);
                }

                return $url;
            })
            ->writeToFile(public_path('sitemap_pages.xml'));

        $sitemapIndex = SitemapIndex::create()
            ->add('sitemap_pages.xml');

        $packages = (array) config('docs.packages', []);
        foreach ($packages as $package => $options) {
            if (! is_string($package) || ! is_array($options)) {
                continue;
            }
            $versions = (array) ($options['versions'] ?? []);
            foreach ($versions as $version => $versionOptions) {
                if (! is_string($version)) {
                    continue;
                }
                SitemapGenerator::create($appUrl.'/docs/'.$package.'/'.$version)
                    ->shouldCrawl(function (UriInterface $url) {
                        return Str::contains($url->getPath(), 'docs');
                    })
                    ->writeToFile(public_path('sitemap_'.$package.'_'.$version.'.xml'));

                $sitemapIndex->add('sitemap_'.$package.'_'.$version.'.xml');
            }
        }

        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
