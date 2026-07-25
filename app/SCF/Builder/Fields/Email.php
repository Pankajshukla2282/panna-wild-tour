<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Email address field. */
class Email extends Field
{
    protected string $placeholder = '';
    protected string $prepend = '';
    protected string $append = '';

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

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'        => 'email',
            'placeholder' => $this->placeholder,
            'prepend'     => $this->prepend,
            'append'      => $this->append,
        ]);
    }
}
