<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Post Object field (single or multiple posts). */
class PostObject extends Field
{
    protected array $postType = [];
    protected array $taxonomy = [];
    protected bool $allowNull = false;
    protected bool $multiple = false;
    protected string $returnFormat = 'object';
    protected string $uiStyle = 'select';

    /** Filter by post type slugs. */
    public function postType(array $types): static
    {
        $this->postType = $types;
        return $this;
    }

    /** Filter by taxonomy terms. */
    public function taxonomy(array $terms): static
    {
        $this->taxonomy = $terms;
        return $this;
    }

    public function allowNull(bool $allow = true): static
    {
        $this->allowNull = $allow;
        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;
        return $this;
    }

    /** Return format: 'object' | 'id' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'post_object',
            'post_type'     => $this->postType,
            'taxonomy'      => $this->taxonomy,
            'allow_null'    => $this->allowNull ? 1 : 0,
            'multiple'      => $this->multiple ? 1 : 0,
            'return_format' => $this->returnFormat,
            'ui'            => 1,
        ]);
    }
}
