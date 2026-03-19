<?php

namespace Tests\Unit\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

describe('github helper', function () {
    beforeEach(function () {
        Cache::flush();
        Http::preventStrayRequests();
    });

    it('fetches github repository data', function () {
        Http::fake([
            'api.github.com/repos/yajra/laravel-datatables' => Http::response([
                'name' => 'laravel-datatables',
                'full_name' => 'yajra/laravel-datatables',
                'stargazers_count' => 5000,
                'forks_count' => 800,
                'description' => 'jQuery DataTables for Laravel',
                'html_url' => 'https://github.com/yajra/laravel-datatables',
            ], 200),
        ]);

        $result = github('laravel-datatables');

        expect($result['name'])->toBe('laravel-datatables')
            ->and($result['stargazers_count'])->toBe(5000)
            ->and($result['forks_count'])->toBe(800)
            ->and($result['description'])->toBe('jQuery DataTables for Laravel');
    });

    it('caches github data for one day', function () {
        Http::fake([
            'api.github.com/*' => Http::response([
                'name' => 'test-repo',
                'stargazers_count' => 100,
            ], 200),
        ]);

        $first = github('test-repo');
        $second = github('test-repo');

        Http::assertSentCount(1);
        expect($first)->toBe($second);
    });
});
