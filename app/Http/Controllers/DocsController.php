<?php

namespace App\Http\Controllers;

use App\Documentation;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class DocsController extends Controller
{
    public function __construct(protected Documentation $docs) {}

    /**
     * Show the root documentation page (/docs).
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showRootPage(?string $package = null)
    {
        $package = $package ?: DEFAULT_PACKAGE;

        if (Str::contains($package, 'datatables')) {
            $package = 'laravel-datatables';
        }

        if (Str::contains($package, 'oci8')) {
            $package = 'laravel-oci8';
        }

        $defaultVersion = Documentation::getDefaultVersion($package);

        return redirect("docs/$package/".$defaultVersion);
    }

    /**
     * Show a documentation page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function show(string $package, ?string $version = null, ?string $page = null)
    {
        $defaultVersion = Documentation::getDefaultVersion($package);

        if (is_null($version) || ! $this->isVersion($package, $version)) {
            return redirect("docs/$package/".$defaultVersion.'/'.$version, 301);
        }

        if (! defined('CURRENT_VERSION')) {
            define('CURRENT_VERSION', $version);
        }

        $sectionPage = $page ?: 'installation';
        $content = $this->docs->get($package, $version, $sectionPage);
        if (empty($content)) {
            $otherVersions = $this->docs->versionsContainingPage($package, $sectionPage);

            return response()->view('docs.show', [
                'title' => 'Page not found',
                'index' => $this->docs->getIndex($package, $version),
                'package' => $package,
                'content' => view('docs.missing', [
                    'otherVersions' => $otherVersions,
                    'package' => $package,
                    'page' => $page,
                ]),
                'currentVersion' => $version,
                'defaultVersion' => $defaultVersion,
                'versions' => Documentation::getDocVersions($package),
                'currentSection' => $otherVersions->isEmpty() ? '' : '/'.$page,
                'canonical' => null,
            ], 404);
        }

        $title = (new Crawler($content))->filterXPath('//h1');

        $section = '';
        if ($this->docs->pageExists($package, $version, $sectionPage)) {
            $section .= '/'.$sectionPage;
        } elseif (! is_null($page)) {
            return redirect("/docs/$package/$version");
        }

        $canonical = null;

        return view('docs.show', [
            'title' => count($title) ? $title->text() : null,
            'index' => $this->docs->getIndex($package, $version),
            'package' => $package,
            'content' => $content,
            'currentVersion' => $version,
            'defaultVersion' => $defaultVersion,
            'versions' => Documentation::getDocVersions($package),
            'currentSection' => $section,
            'canonical' => $canonical,
            'repositoryLink' => Documentation::getRepositoryLink($package, $version, $sectionPage),
        ]);
    }

    /**
     * Determine if the given URL segment is a valid version.
     */
    protected function isVersion(string $package, string $version): bool
    {
        return in_array($version, array_keys(Documentation::getDocVersions($package)));
    }

    /**
     * Show the documentation index JSON representation.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function index(string $package, string $version, Documentation $docs)
    {
        $major = Str::before($version, '.');
        $versions = Documentation::getDocVersions($package);
        $defaultVersion = Documentation::getDefaultVersion($package);

        if ((int) Str::before(array_values($versions)[1], '.') + 1 === (int) $major) {
            $version = $major = 'master';
        }

        if (! $this->isVersion($package, $version)) {
            return redirect("docs/$package/".$defaultVersion.'/index.json', 301);
        }

        if ($major !== 'master' && $major < 9) {
            return response()->json([]);
        }

        return response()->json($docs->indexArray($package, $version));
    }
}
