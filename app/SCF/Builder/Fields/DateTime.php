<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Date + time picker field. */
class DateTime extends Field
{
    protected string $displayFormat = 'd/m/Y g:i a';
    protected string $returnFormat = 'd/m/Y g:i a';
    protected string $firstDay = '1';

    /** Datetime format shown in the picker UI (PHP date format). */
    public function displayFormat(string $format): static
    {
        $this->displayFormat = $format;
        return $this;
    }

    /** Datetime format returned by get_field() (PHP date format). */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    /** First day of week: '0' = Sunday, '1' = Monday. */
    public function firstDay(string $day): static
    {
        $this->firstDay = $day;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'           => 'date_time_picker',
            'display_format' => $this->displayFormat,
            'return_format'  => $this->returnFormat,
            'first_day'      => $this->firstDay,
        ]);
    }
}
