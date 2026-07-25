<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Group field — organises sub-fields into a single named object. */
class GroupField extends Field
{
    protected array $subFields = [];
    protected string $layout = 'block';
    protected string $style = 'default';

    public function addField(Field $field): static
    {
        $this->subFields[] = $field;
        return $this;
    }

    public function subFields(array $fields): static
    {
        $this->subFields = $fields;
        return $this;
    }

    /** Layout: 'block' | 'table' | 'row' */
    public function layout(string $layout): static
    {
        $this->layout = $layout;
        return $this;
    }

    /** Style: 'default' | 'seamless' */
    public function style(string $style): static
    {
        $this->style = $style;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'       => 'group',
            'layout'     => $this->layout,
            'style'      => $this->style,
            'sub_fields' => array_map(fn(Field $f) => $f->build(), $this->subFields),
        ]);
    }
}
