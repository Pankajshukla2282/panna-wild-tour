<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** URL input field. */
class Url extends Field
{
    protected string $placeholder = '';

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'        => 'url',
            'placeholder' => $this->placeholder,
        ]);
    }
}
