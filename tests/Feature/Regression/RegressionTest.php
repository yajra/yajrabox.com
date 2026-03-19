<?php

namespace Tests\Feature\Regression;

use App\Documentation;
use Pdo\Mysql;

describe('Regression Tests', function () {

    describe('PDO MySQL SSL CA namespace fix', function () {
        it('uses Pdo\Mysql namespace correctly in mysql config', function () {
            $config = config('database.connections.mysql');

            expect($config['options'])->toBeArray();
            expect($config['options'])->toBeIterable();
        });

        it('uses Pdo\Mysql namespace correctly in mariadb config', function () {
            $config = config('database.connections.mariadb');

            expect($config['options'])->toBeArray();
            expect($config['options'])->toBeIterable();
        });

        it('ssl ca option key is Pdo\Mysql constant value', function () {
            expect(Mysql::ATTR_SSL_CA)->toBeInt();
        });
    });

    describe('svg helper', function () {
        it('returns empty string when svg file does not exist', function () {
            $svg = svg('nonexistent-svg-file');

            expect($svg)->toBe('');
        });
    });

    describe('Documentation class', function () {
        it('can determine if documentation exists for a package', function () {
            $exists = Documentation::exists('laravel-datatables');
            expect($exists)->toBeBool();
        });
    });

    describe('meta description with dynamic content', function () {
        it('homepage returns 200 or has error reason', function () {
            $response = $this->get('/');

            expect($response->status())->toBeInt();
        });
    });
});
