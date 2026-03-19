<?php

namespace Tests\Unit\Documentation;

use App\Documentation\Frontmatter;
use PHPUnit\Framework\TestCase;

class FrontmatterTest extends TestCase
{
    public function test_parses_yaml_frontmatter(): void
    {
        $markdown = <<<'MD'
---
title: Test Page Title
description: A test description
---

# Content Here

Some markdown content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertTrue($frontmatter->hasFrontmatter());
        $this->assertEquals('Test Page Title', $frontmatter->getTitle());
        $this->assertEquals('A test description', $frontmatter->getDescription());
        $this->assertStringStartsWith('# Content Here', $frontmatter->getContent());
        $this->assertStringContainsString('Some markdown content.', $frontmatter->getContent());
    }

    public function test_handles_content_without_frontmatter(): void
    {
        $markdown = <<<'MD'
# Just a Title

Some content without frontmatter.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertFalse($frontmatter->hasFrontmatter());
        $this->assertNull($frontmatter->getTitle());
        $this->assertNull($frontmatter->getDescription());
        $this->assertEquals($markdown, $frontmatter->getContent());
        $this->assertEquals([], $frontmatter->all());
    }

    public function test_handles_empty_frontmatter(): void
    {
        $markdown = <<<'MD'
---
---

# Content
MD;

        $frontmatter = Frontmatter::parse($markdown);

        // Empty frontmatter should still parse but not set hasFrontmatter
        $this->assertEquals('# Content', $frontmatter->getContent());
    }

    public function test_get_custom_attribute(): void
    {
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

        $this->assertEquals('getting-started', $frontmatter->get('category'));
        $this->assertEquals(1, $frontmatter->get('order'));
        $this->assertEquals('default', $frontmatter->get('nonexistent', 'default'));
    }

    public function test_to_collection(): void
    {
        $markdown = <<<'MD'
---
title: Test
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);
        $collection = $frontmatter->toCollection();

        $this->assertEquals('Test', $collection->get('title'));
    }

    public function test_has_method(): void
    {
        $markdown = <<<'MD'
---
title: Test
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertTrue($frontmatter->has('title'));
        $this->assertFalse($frontmatter->has('nonexistent'));
        $this->assertFalse($frontmatter->has('description'));
    }

    public function test_magic_getter(): void
    {
        $markdown = <<<'MD'
---
title: Magic Test
category: test-category
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertEquals('Magic Test', $frontmatter->title);
        $this->assertEquals('test-category', $frontmatter->category);
        $this->assertNull($frontmatter->nonexistent);
    }

    public function test_magic_isset(): void
    {
        $markdown = <<<'MD'
---
title: Magic Test
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertTrue(isset($frontmatter->title));
        $this->assertFalse(isset($frontmatter->nonexistent));
    }

    public function test_all_returns_data_array(): void
    {
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

        $this->assertIsArray($all);
        $this->assertArrayHasKey('title', $all);
        $this->assertArrayHasKey('description', $all);
        $this->assertArrayHasKey('category', $all);
    }

    public function test_quoted_string_values(): void
    {
        $markdown = <<<'MD'
---
title: "Quoted Title"
description: 'Single Quoted'
---

Content.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertEquals('Quoted Title', $frontmatter->getTitle());
        $this->assertEquals('Single Quoted', $frontmatter->getDescription());
    }

    public function test_multiline_content_without_frontmatter(): void
    {
        $markdown = <<<'MD'
# Multi-line Content

This is a paragraph
that spans multiple
lines in the source.
MD;

        $frontmatter = Frontmatter::parse($markdown);

        $this->assertFalse($frontmatter->hasFrontmatter());
        $this->assertStringContainsString('Multi-line Content', $frontmatter->getContent());
    }

    public function test_frontmatter_at_start_only(): void
    {
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

        $this->assertEquals('Title', $frontmatter->getTitle());
        $this->assertStringStartsWith('# First Heading', $frontmatter->getContent());
        $this->assertStringContainsString('---', $frontmatter->getContent()); // HR in content
        $this->assertStringContainsString('Another Section', $frontmatter->getContent());
    }
}
