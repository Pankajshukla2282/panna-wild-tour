<?php

namespace PWT\SCF\Builder;

defined('ABSPATH') || exit;

/**
 * Flexible Content layout entry (used inside FlexibleContent fields).
 */
class Layout
{
    /** @var string Unique layout key */
    protected string $key = '';

    /** @var string Layout name / slug */
    protected string $name = '';

    /** @var string Human-readable label */
    protected string $label = '';

    /** @var string Display mode: 'block' | 'table' | 'row' */
    protected string $display = 'block';

    /** @var int|null Minimum number of instances */
    protected ?int $min = null;

    /** @var int|null Maximum number of instances */
    protected ?int $max = null;

    /** @var Field[] Sub-fields for this layout */
    protected array $subFields = [];

    /** Set the unique layout key. */
    public function key(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    /** Set the layout name (slug). */
    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /** Set the layout label. */
    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    /** Set the display mode ('block', 'table', or 'row'). */
    public function display(string $display): static
    {
        $this->display = $display;
        return $this;
    }

    /** Set minimum instances. */
    public function min(int $min): static
    {
        $this->min = $min;
        return $this;
    }

    /** Set maximum instances. */
    public function max(int $max): static
    {
        $this->max = $max;
        return $this;
    }

    /** Add a sub-field to this layout. */
    public function addField(Field $field): static
    {
        $this->subFields[] = $field;
        return $this;
    }

    /** Set all sub-fields. */
    public function subFields(array $fields): static
    {
        $this->subFields = $fields;
        return $this;
    }

    /** Build and return the layout configuration array. */
    public function build(): array
    {
        return [
            'key'        => $this->key,
            'name'       => $this->name,
            'label'      => $this->label,
            'display'    => $this->display,
            'min'        => $this->min,
            'max'        => $this->max,
            'sub_fields' => array_map(fn(Field $f) => $f->build(), $this->subFields),
        ];
    }
}
