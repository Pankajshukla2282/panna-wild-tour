<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Link (URL + title + target) field. */
class Link extends Field
{
    protected string $returnFormat = 'array';

    /** Return format: 'array' | 'url' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'link',
            'return_format' => $this->returnFormat,
        ]);
    }
}
