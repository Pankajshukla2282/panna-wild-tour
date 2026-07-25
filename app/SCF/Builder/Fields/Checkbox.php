<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Checkbox field (multi-select). */
class Checkbox extends Field
{
    protected array $choices = [];
    protected array $defaultValues = [];
    protected string $layout = 'vertical';
    protected bool $allowCustom = false;
    protected string $returnFormat = 'value';

    public function choices(array $choices): static
    {
        $this->choices = $choices;
        return $this;
    }

    /** Layout: 'vertical' | 'horizontal' */
    public function layout(string $layout): static
    {
        $this->layout = $layout;
        return $this;
    }

    public function allowCustom(bool $allow = true): static
    {
        $this->allowCustom = $allow;
        return $this;
    }

    /** Return format: 'value' | 'label' | 'array' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'checkbox',
            'choices'       => $this->choices,
            'layout'        => $this->layout,
            'allow_custom'  => $this->allowCustom ? 1 : 0,
            'return_format' => $this->returnFormat,
        ]);
    }
}
