<?php

namespace App\Documentation;

use Illuminate\Support\Collection;

/**
 * Parses YAML frontmatter from markdown content.
 *
 * Frontmatter format:
 * ---
 * title: Page Title
 * description: A description
 * ---
 *
 * Markdown content here...
 */
class Frontmatter
{
    /**
     * The frontmatter data.
     */
    protected array $data = [];

    /**
     * The raw markdown content without frontmatter.
     */
    protected string $content = '';

    /**
     * Whether frontmatter markers were found in the content.
     */
    protected bool $hasMarkers = false;

    /**
     * Parse frontmatter from markdown content.
     */
    public static function parse(string $markdown): self
    {
        $instance = new self;

        // Check if content starts with frontmatter delimiters
        if (! preg_match('/^---\s*\n/', $markdown)) {
            $instance->content = $markdown;

            return $instance;
        }

        // Extract frontmatter block (between first --- and second ---)
        // Pattern supports: --- <content> --- and --- <content> \n ---
        if (preg_match('/^---\s*\n((?:.*?\n)?)(?:---\s*\n?)(.*)$/s', $markdown, $matches)) {
            $yaml = trim($matches[1]);
            $instance->content = $matches[2];

            // Check if frontmatter block exists (markers were found)
            // Note: empty frontmatter still counts as having frontmatter
            $instance->hasMarkers = true;

            try {
                // Only parse if there's actual YAML content
                if ($yaml !== '') {
                    $instance->data = self::parseSimpleYaml($yaml);
                }
            } catch (\Exception $e) {
                // If YAML parsing fails, treat as regular content
                $instance->content = $markdown;
                $instance->data = [];
            }
        }

        return $instance;
    }

    /**
     * Simple YAML parser for basic frontmatter patterns.
     * Supports: key-value, lists, nested objects (limited).
     */
    protected static function parseSimpleYaml(string $yaml): array
    {
        $result = [];
        $lines = explode("\n", $yaml);
        $currentKey = null;
        $currentIndent = 0;
        $stack = [&$result];
        $indentStack = [0];
        $inList = false;
        $listItems = [];

        foreach ($lines as $line) {
            // Skip empty lines
            if (trim($line) === '') {
                if ($inList) {
                    // Empty line might end a list
                }

                continue;
            }

            // Determine indentation
            preg_match('/^(\s*)/', $line, $indentMatch);
            $indent = strlen($indentMatch[1]);
            $trimmedLine = trim($line);

            // Handle list items
            if (preg_match('/^-\s*(.*)$/', $trimmedLine, $listMatch)) {
                $inList = true;
                $listItems[] = trim($listMatch[1]);

                // Store the list when we encounter a non-list item
                if ($currentKey !== null && ! isset($result[$currentKey])) {
                    $result[$currentKey] = $listItems;
                } elseif ($currentKey !== null) {
                    $result[$currentKey] = $listItems;
                }

                continue;
            }

            // End of list
            if ($inList && ! preg_match('/^-\s/', $trimmedLine)) {
                $inList = false;
                $listItems = [];
            }

            // Handle key-value pairs
            if (preg_match('/^([^:]+):\s*(.*)$/', $trimmedLine, $kvMatch)) {
                $key = trim($kvMatch[1]);
                $value = trim($kvMatch[2]);

                // Handle quoted values
                if (preg_match('/^["\'](.*)["\']\s*$/', $value, $quoteMatch)) {
                    $value = $quoteMatch[1];
                }

                // Handle empty values (could be start of nested object)
                if ($value === '') {
                    $currentKey = $key;
                    $currentIndent = $indent;

                    // Check if next non-empty line is a list
                    continue;
                }

                $result[$key] = self::parseYamlValue($value);
                $currentKey = null;
            }
        }

        return $result;
    }

    /**
     * Parse a YAML value to its appropriate PHP type.
     */
    protected static function parseYamlValue(string $value): mixed
    {
        // Null
        if ($value === '~' || $value === 'null' || $value === '') {
            return null;
        }

        // Boolean
        if ($value === 'true' || $value === 'false') {
            return $value === 'true';
        }

        // Integer
        if (ctype_digit($value) || (str_starts_with($value, '-') && ctype_digit(substr($value, 1)))) {
            return (int) $value;
        }

        // Float
        if (is_numeric($value)) {
            return (float) $value;
        }

        // Quoted strings
        if (preg_match('/^["\'](.*)["\']\s*$/', $value, $matches)) {
            return $matches[1];
        }

        // Literal block scalar (|) - take first line
        if (str_starts_with($value, '|')) {
            return trim(substr($value, 1));
        }

        // Regular string
        return $value;
    }

    /**
     * Get the title from frontmatter or null.
     */
    public function getTitle(): ?string
    {
        return $this->data['title'] ?? null;
    }

    /**
     * Get the description from frontmatter or null.
     */
    public function getDescription(): ?string
    {
        return $this->data['description'] ?? null;
    }

    /**
     * Get a custom attribute from frontmatter.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * Get all frontmatter data.
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * Check if frontmatter exists.
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * Get the markdown content without frontmatter.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Check if this document has frontmatter.
     */
    public function hasFrontmatter(): bool
    {
        return $this->hasMarkers;
    }

    /**
     * Get frontmatter as a Collection for convenient manipulation.
     */
    public function toCollection(): Collection
    {
        return new Collection($this->data);
    }

    /**
     * Magic getter for easy access to frontmatter data.
     */
    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    /**
     * Check if a property is set.
     */
    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }
}
