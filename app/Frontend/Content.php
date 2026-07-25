<?php

namespace PWT\Frontend;

defined('ABSPATH') || exit;

class Content
{
    public static function getField(int $postId, string $fieldName)
    {
        if (function_exists('get_field')) {
            $value = get_field($fieldName, $postId);

            if ($value !== null && $value !== false && $value !== '') {
                return $value;
            }
        }

        if (function_exists('scf_get_field')) {
            $value = scf_get_field($fieldName, $postId);

            if ($value !== null && $value !== false && $value !== '') {
                return $value;
            }
        }

        return get_post_meta($postId, $fieldName, true);
    }

    public static function getRepeaterRows(int $postId, string $fieldName, array $subFields): array
    {
        $value = self::getField($postId, $fieldName);

        if (is_array($value) && self::isListOfRows($value)) {
            return $value;
        }

        $rowCount = (int) get_post_meta($postId, $fieldName, true);

        if ($rowCount < 1) {
            return [];
        }

        $rows = [];

        for ($index = 0; $index < $rowCount; $index++) {
            $row = [];

            foreach ($subFields as $subField) {
                $row[$subField] = get_post_meta($postId, $fieldName . '_' . $index . '_' . $subField, true);
            }

            if (array_filter($row, static fn ($item) => $item !== '' && $item !== null)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    private static function isListOfRows(array $value): bool
    {
        if ($value === []) {
            return true;
        }

        return isset($value[0]) && is_array($value[0]);
    }
}
