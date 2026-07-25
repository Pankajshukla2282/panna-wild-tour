<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Dropdown select field. */
class Select extends Field
{
    protected array $choices = [];
    protected bool $allowNull = false;
    protected bool $multiple = false;
    protected bool $ui = false;
    protected bool $ajax = false;
    protected string $placeholder = '';
    protected string $returnFormat = 'value';

    /** Set choices as ['value' => 'Label'] or ['Label']. */
    public function choices(array $choices): static
    {
        $this->choices = $choices;
        return $this;
    }

    public function allowNull(bool $allow = true): static
    {
        $this->allowNull = $allow;
        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;
        return $this;
    }

    /** Enable Select2 UI. */
    public function ui(bool $ui = true): static
    {
        $this->ui = $ui;
        return $this;
    }

    /** Enable AJAX loading for Select2. */
    public function ajax(bool $ajax = true): static
    {
        $this->ajax = $ajax;
        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /** Return format: 'value' | 'label' | 'array' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'select',
            'choices'       => $this->choices,
            'allow_null'    => $this->allowNull ? 1 : 0,
            'multiple'      => $this->multiple ? 1 : 0,
            'ui'            => $this->ui ? 1 : 0,
            'ajax'          => $this->ajax ? 1 : 0,
            'placeholder'   => $this->placeholder,
            'return_format' => $this->returnFormat,
        ]);
    }
}
