<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Range slider field. */
class Range extends Field
{
    protected $min = 0;
    protected $max = 100;
    protected $step = 1;
    protected string $prepend = '';
    protected string $append = '';

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

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'    => 'range',
            'min'     => $this->min,
            'max'     => $this->max,
            'step'    => $this->step,
            'prepend' => $this->prepend,
            'append'  => $this->append,
        ]);
    }
}
