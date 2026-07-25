<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Color picker field. */
class Color extends Field
{
    protected bool $enableOpacity = false;
    protected string $returnFormat = 'string';

    /** Enable alpha / opacity control. */
    public function opacity(bool $enable = true): static
    {
        $this->enableOpacity = $enable;
        return $this;
    }

    /** Return format: 'string' | 'array' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'           => 'color_picker',
            'enable_opacity' => $this->enableOpacity ? 1 : 0,
            'return_format'  => $this->returnFormat,
        ]);
    }
}
