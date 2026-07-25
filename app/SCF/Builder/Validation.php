<?php

declare(strict_types=1);

namespace PWT\SCF\Builder;

defined('ABSPATH') || exit;

/**
 * Validation Builder.
 *
 * Provides reusable validation rules that are merged into
 * a field configuration.
 */
class Validation
{
    /**
     * Validation configuration.
     *
     * @var array<string,mixed>
     */
    protected array $rules = [];

    /**
     * Required.
     */
    public function required(
        bool $required = true
    ): static {

        $this->rules['required'] = $required ? 1 : 0;

        return $this;

    }

    /**
     * Minimum value.
     */
    public function min(
        int|float $value
    ): static {

        $this->rules['min'] = $value;

        return $this;

    }

    /**
     * Maximum value.
     */
    public function max(
        int|float $value
    ): static {

        $this->rules['max'] = $value;

        return $this;

    }

    /**
     * Minimum length.
     */
    public function minLength(
        int $length
    ): static {

        $this->rules['min_length'] = $length;

        return $this;

    }

    /**
     * Maximum length.
     */
    public function maxLength(
        int $length
    ): static {

        $this->rules['maxlength'] = $length;

        return $this;

    }

    /**
     * Regular expression.
     */
    public function regex(
        string $pattern
    ): static {

        $this->rules['pattern'] = $pattern;

        return $this;

    }

    /**
     * Allow HTML5 readonly validation.
     */
    public function readonly(
        bool $readonly = true
    ): static {

        $this->rules['readonly'] = $readonly ? 1 : 0;

        return $this;

    }

    /**
     * Allow null values.
     */
    public function allowNull(
        bool $allow = true
    ): static {

        $this->rules['allow_null'] = $allow ? 1 : 0;

        return $this;

    }

    /**
     * Mark field as unique.
     *
     * Reserved for future validation hooks.
     */
    public function unique(
        bool $unique = true
    ): static {

        $this->rules['pwt_unique'] = $unique;

        return $this;

    }

    /**
     * Custom validation callback.
     */
    public function callback(
        callable $callback
    ): static {

        $this->rules['pwt_callback'] = $callback;

        return $this;

    }

    /**
     * Merge additional rules.
     *
     * @param array<string,mixed> $rules
     */
    public function merge(
        array $rules
    ): static {

        $this->rules = array_replace_recursive(
            $this->rules,
            $rules
        );

        return $this;

    }

    /**
     * Export validation rules.
     *
     * @return array<string,mixed>
     */
    public function build(): array
    {
        return $this->rules;
    }

    /**
     * Convert validation rules to array.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return $this->build();
    }

    /**
     * Export validation rules as JSON.
     */
    public function toJson(
        int $flags = JSON_PRETTY_PRINT
    ): string {

        return wp_json_encode(
            $this->rules,
            $flags
        );

    }

    /**
     * String representation.
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}