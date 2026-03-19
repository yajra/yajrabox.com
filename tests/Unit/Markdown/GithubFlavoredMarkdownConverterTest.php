<?php

namespace Tests\Unit;

use App\Markdown\GithubFlavoredMarkdownConverter;

describe('GithubFlavoredMarkdownConverter', function () {
    it('creates instance successfully', function () {
        $converter = new GithubFlavoredMarkdownConverter;

        expect($converter)->toBeInstanceOf(GithubFlavoredMarkdownConverter::class);
    });

    it('has environment configured', function () {
        $converter = new GithubFlavoredMarkdownConverter;

        expect($converter->getEnvironment())->not->toBeNull();
    });

    it('converts markdown to html', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert('# Hello World');

        expect((string) $result)->toContain('<h1>');
    });

    it('converts bold text', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert('**bold text**');

        expect((string) $result)->toContain('<strong>bold text</strong>');
    });

    it('converts italic text', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert('*italic text*');

        expect((string) $result)->toContain('<em>italic text</em>');
    });

    it('converts links', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert('[Link](https://example.com)');

        expect((string) $result)->toContain('<a href="https://example.com">Link</a>');
    });

    it('converts code blocks', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert('```php\necho "test";\n```');

        expect((string) $result)->toContain('<code');
    });

    it('converts inline code', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert('`inline code`');

        expect((string) $result)->toContain('<code>inline code</code>');
    });

    it('converts lists', function () {
        $converter = new GithubFlavoredMarkdownConverter;
        $result = $converter->convert("- Item 1\n- Item 2");

        expect((string) $result)->toContain('<ul>');
    });
});
