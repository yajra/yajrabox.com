<?php

namespace Tests\Unit\Regression;

describe('Regression Tests', function () {

    describe('package_to_title helper', function () {
        it('converts package names to title case', function () {
            expect(package_to_title('laravel-datatables'))->toBe('Laravel DataTables');
            expect(package_to_title('foo-bar'))->toBe('Foo Bar');
            expect(package_to_title('test-package'))->toBe('Test Package');
        });

        it('handles datatables suffix correctly', function () {
            expect(package_to_title('datatables-html'))->toBe('DataTables Html');
            expect(package_to_title('datatables-buttons'))->toBe('DataTables Buttons');
        });

        it('preserves DataTables capitalization', function () {
            expect(package_to_title('datatables-editor'))->toBe('DataTables Editor');
            expect(package_to_title('datatables-fractal'))->toBe('DataTables Fractal');
        });
    });

    describe('svg helper', function () {
        it('returns empty string when svg file does not exist', function () {
            $svg = svg('nonexistent-svg-file');

            expect($svg)->toBe('');
        });
    });
});
