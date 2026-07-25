<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Numeric input field. */
class Number extends Field
{
    protected string $placeholder = '';
    protected string $prepend = '';
    protected string $append = '';
    protected $min = '';
    protected $max = '';
    protected $step = '';

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function prepend(string $prepend): static
    {
        $this->prepend = $prepend;
        return $this;
    }

    public function append(string $append): static
    {
        $this->append = $append;
        return $this;
    }

    public function min($min): static
    {
        $this->min = $min;
        return $this;
    }

    public function max($max): static
    {
        $this->max = $max;
        return $this;
    }

    public function step($step): static
    {
        $this->step = $step;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'        => 'number',
            'placeholder' => $this->placeholder,
            'prepend'     => $this->prepend,
            'append'      => $this->append,
            'min'         => $this->min,
            'max'         => $this->max,
            'step'        => $this->step,
        ]);
    }
}
