<?php

declare(strict_types=1);

namespace PWT\SCF\Builder;

defined('ABSPATH') || exit;

/**
 * Builds SCF/ACF conditional logic rules.
 *
 * Example:
 *
 * (new Conditional())
 *     ->field('enable_booking')
 *     ->equals(1)
 *     ->field('price_type')
 *     ->notEquals('free');
 */
class Conditional
{
    /**
     * Conditional groups.
     *
     * @var array<int,array<int,array<string,mixed>>>
     */
    protected array $groups = [];

    /**
     * Current group index.
     */
    protected int $group = 0;

    /**
     * Current field.
     */
    protected ?string $currentField = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->groups[] = [];
    }

    /**
     * Start a new OR group.
     */
    public function orGroup(): static
    {
        $this->group++;

        $this->groups[$this->group] = [];

        return $this;
    }

    /**
     * Select field.
     */
    public function field(
        string $field
    ): static {

        $this->currentField = $field;

        return $this;
    }

    /**
     * Equals.
     */
    public function equals(
        mixed $value
    ): static {

        return $this->rule(
            '==',
            $value
        );
    }

    /**
     * Not Equals.
     */
    public function notEquals(
        mixed $value
    ): static {

        return $this->rule(
            '!=',
            $value
        );
    }

    /**
     * Greater Than.
     */
    public function greaterThan(
        mixed $value
    ): static {

        return $this->rule(
            '>',
            $value
        );
    }

    /**
     * Less Than.
     */
    public function lessThan(
        mixed $value
    ): static {

        return $this->rule(
            '<',
            $value
        );
    }

    /**
     * Has Value.
     */
    public function hasValue(): static
    {
        return $this->rule(
            '!=empty',
            ''
        );
    }

    /**
     * Empty.
     */
    public function isEmpty(): static
    {
        return $this->rule(
            '==empty',
            ''
        );
    }

    /**
     * Internal rule builder.
     */
    protected function rule(
        string $operator,
        mixed $value
    ): static {

        if (!$this->currentField) {
            return $this;
        }

        $this->groups[$this->group][] = [

            'field' => $this->currentField,

            'operator' => $operator,

            'value' => $value,

        ];

        return $this;
    }

    /**
     * Merge another conditional object.
     */
    public function merge(
        Conditional $conditional
    ): static {

        $this->groups = array_merge(
            $this->groups,
            $conditional->build()
        );

        return $this;
    }

    /**
     * Export.
     *
     * @return array<int,array<int,array<string,mixed>>>
     */
    public function build(): array
    {
        return $this->groups;
    }

    /**
     * Array export.
     *
     * @return array<int,array<int,array<string,mixed>>>
     */
    public function toArray(): array
    {
        return $this->build();
    }

    /**
     * JSON export.
     */
    public function toJson(
        int $flags = JSON_PRETTY_PRINT
    ): string {

        return wp_json_encode(
            $this->groups,
            $flags
        );

    }

    /**
     * String conversion.
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}