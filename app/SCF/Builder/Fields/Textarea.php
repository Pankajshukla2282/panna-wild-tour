<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Multi-line textarea field. */
class Textarea extends Field
{
    protected string $placeholder = '';
    protected int $maxlength = 0;
    protected int $rows = 8;
    protected string $newLines = 'wpautop';

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

    public function rows(int $rows): static
    {
        $this->rows = $rows;
        return $this;
    }

    /** New lines handling: 'wpautop' | 'br' | '' */
    public function newLines(string $mode): static
    {
        $this->newLines = $mode;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'        => 'textarea',
            'placeholder' => $this->placeholder,
            'maxlength'   => $this->maxlength ?: '',
            'rows'        => $this->rows,
            'new_lines'   => $this->newLines,
        ]);
    }
}
