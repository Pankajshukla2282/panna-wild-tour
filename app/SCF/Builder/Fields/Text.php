<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Single-line text input field. */
class Text extends Field
{
    protected string $placeholder = '';
    protected int $maxlength = 0;
    protected string $prepend = '';
    protected string $append = '';

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function maxlength(int $max): static
    {
        $this->maxlength = $max;
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
            'type'        => 'text',
            'placeholder' => $this->placeholder,
            'maxlength'   => $this->maxlength ?: '',
            'prepend'     => $this->prepend,
            'append'      => $this->append,
        ]);
    }
}
