<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Time picker field. */
class Time extends Field
{
    protected string $displayFormat = 'g:i a';
    protected string $returnFormat = 'g:i a';

    /** Time format shown in the picker UI (PHP date format). */
    public function displayFormat(string $format): static
    {
        $this->displayFormat = $format;
        return $this;
    }

    /** Time format returned by get_field() (PHP date format). */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'           => 'time_picker',
            'display_format' => $this->displayFormat,
            'return_format'  => $this->returnFormat,
        ]);
    }
}
