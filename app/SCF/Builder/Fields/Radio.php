<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Radio button field. */
class Radio extends Field
{
    protected array $choices = [];
    protected bool $allowNull = false;
    protected bool $allowCustom = false;
    protected bool $saveCustom = false;
    protected string $layout = 'vertical';
    protected string $returnFormat = 'value';

    public function choices(array $choices): static
    {
        $this->choices = $choices;
        return $this;
    }

    public function allowNull(bool $allow = true): static
    {
        $this->allowNull = $allow;
        return $this;
    }

    public function allowCustom(bool $allow = true): static
    {
        $this->allowCustom = $allow;
        return $this;
    }

    public function saveCustom(bool $save = true): static
    {
        $this->saveCustom = $save;
        return $this;
    }

    /** Layout: 'vertical' | 'horizontal' */
    public function layout(string $layout): static
    {
        $this->layout = $layout;
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
            'type'          => 'radio',
            'choices'       => $this->choices,
            'allow_null'    => $this->allowNull ? 1 : 0,
            'allow_custom'  => $this->allowCustom ? 1 : 0,
            'save_custom'   => $this->saveCustom ? 1 : 0,
            'layout'        => $this->layout,
            'return_format' => $this->returnFormat,
        ]);
    }
}
