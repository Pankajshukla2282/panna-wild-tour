<?php

namespace PWT\SCF\Builder\Support;

defined('ABSPATH') || exit;

/**
 * General-purpose helper utilities for the SCF Builder.
 */
class Helpers
{
    /**
     * Generate a deterministic field key from a name string.
     *
     * Prefixes the sanitised name with 'field_' to match SCF convention.
     *
     * @param  string $name  Human-readable or slug name.
     * @return string        e.g. 'field_package_price'
     */
    public static function generateKey(string $name): string
    {
        return 'field_' . self::sanitizeName($name);
    }

    /**
     * Sanitise a name to a lowercase underscored slug.
     *
     * @param  string $name
     * @return string
     */
    public static function sanitizeName(string $name): string
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9]+/', '_', $slug);
        return trim((string) $slug, '_');
    }

    /**
     * Deep-merge default field values into a field config array.
     *
     * Keys present in $field take precedence over $defaults.
     *
     * @param  array $field     The field's own config.
     * @param  array $defaults  Default values to fall back to.
     * @return array            Merged config.
     */
    public static function mergeDefaults(array $field, array $defaults): array
    {
        return array_merge($defaults, $field);
    }
}
