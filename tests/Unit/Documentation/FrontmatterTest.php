<?php

namespace Tests\Unit\Documentation;

use App\Documentation\Frontmatter;

describe('Frontmatter', function () {
    it('parses yaml frontmatter', function () {
        $markdown = <<<'MD'
---
title: Test Page Title
description: A test description
---

# Content Here

Some markdown content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->hasFrontmatter())->toBeTrue()
            ->and($frontmatter->getTitle())->toBe('Test Page Title')
            ->and($frontmatter->getDescription())->toBe('A test description')
            ->and($frontmatter->getContent())->toStartWith('# Content Here')
            ->and($frontmatter->getContent())->toContain('Some markdown content.');
    });

    it('handles content without frontmatter', function () {
        $markdown = <<<'MD'
# Just a Title

Some content without frontmatter.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->hasFrontmatter())->toBeFalse()
            ->and($frontmatter->getTitle())->toBeNull()
            ->and($frontmatter->getDescription())->toBeNull()
            ->and($frontmatter->getContent())->toBe($markdown)
            ->and($frontmatter->all())->toBe([]);
    });

    it('handles empty frontmatter', function () {
        $markdown = <<<'MD'
---
---

# Content
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->getContent())->toBe('# Content');
    });

    it('gets custom attribute', function () {
        $markdown = <<<'MD'
---
title: Custom Page
category: getting-started
order: 1
featured: true
---

Content here.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->get('category'))->toBe('getting-started')
            ->and($frontmatter->get('order'))->toBe(1)
            ->and($frontmatter->get('nonexistent', 'default'))->toBe('default');
    });

    it('converts to collection', function () {
        $markdown = <<<'MD'
---
title: Test
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);
        $collection = $frontmatter->toCollection();

        expect($collection->get('title'))->toBe('Test');
    });

    it('has method works correctly', function () {
        $markdown = <<<'MD'
---
title: Test
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->has('title'))->toBeTrue()
            ->and($frontmatter->has('nonexistent'))->toBeFalse()
            ->and($frontmatter->has('description'))->toBeFalse();
    });

    it('magic getter works', function () {
        $markdown = <<<'MD'
---
title: Magic Test
category: test-category
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->title)->toBe('Magic Test')
            ->and($frontmatter->category)->toBe('test-category')
            ->and($frontmatter->nonexistent)->toBeNull();
    });

    it('magic isset works', function () {
        $markdown = <<<'MD'
---
title: Magic Test
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect(isset($frontmatter->title))->toBeTrue()
            ->and(isset($frontmatter->nonexistent))->toBeFalse();
    });

    it('all returns data array', function () {
        $markdown = <<<'MD'
---
title: Full Test
description: A full test
category: docs
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);
        $all = $frontmatter->all();

        expect($all)->toBeArray()
            ->toHaveKeys(['title', 'description', 'category']);
    });

    it('parses quoted string values', function () {
        $markdown = <<<'MD'
---
title: "Quoted Title"
description: 'Single Quoted'
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->getTitle())->toBe('Quoted Title')
            ->and($frontmatter->getDescription())->toBe('Single Quoted');
    });

    it('handles multiline content without frontmatter', function () {
        $markdown = <<<'MD'
# Multi-line Content

This is a paragraph
that spans multiple
lines in the source.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->hasFrontmatter())->toBeFalse()
            ->and($frontmatter->getContent())->toContain('Multi-line Content');
    });

    it('parses frontmatter at start only', function () {
        $markdown = <<<'MD'
---
title: Title
---

# First Heading

Some content

---

## Another Section

More content
MD;

        $frontmatter = Frontmatter::parse($markdown);

        expect($frontmatter->getTitle())->toBe('Title')
            ->and($frontmatter->getContent())->toStartWith('# First Heading')
            ->and($frontmatter->getContent())->toContain('---')
            ->and($frontmatter->getContent())->toContain('Another Section');
    });
});
