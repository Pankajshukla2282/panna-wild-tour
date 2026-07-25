<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Taxonomy term selector field. */
class Taxonomy extends Field
{
    protected string $taxonomy = 'category';
    protected string $fieldType = 'checkbox';
    protected bool $allowNull = false;
    protected bool $addTerm = false;
    protected bool $saveTerms = false;
    protected bool $loadTerms = false;
    protected string $returnFormat = 'id';
    protected bool $multiple = false;

    /** Taxonomy slug (e.g. 'category', 'post_tag'). */
    public function taxonomy(string $taxonomy): static
    {
        $this->taxonomy = $taxonomy;
        return $this;
    }

    /** UI type: 'checkbox' | 'multi_select' | 'radio' | 'select' */
    public function fieldType(string $type): static
    {
        $this->fieldType = $type;
        return $this;
    }

    public function allowNull(bool $allow = true): static
    {
        $this->allowNull = $allow;
        return $this;
    }

    /** Allow creating new terms from the field. */
    public function addTerm(bool $add = true): static
    {
        $this->addTerm = $add;
        return $this;
    }

    /** Save selected terms to the post. */
    public function saveTerms(bool $save = true): static
    {
        $this->saveTerms = $save;
        return $this;
    }

    /** Load the post's existing terms. */
    public function loadTerms(bool $load = true): static
    {
        $this->loadTerms = $load;
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
            'type'          => 'taxonomy',
            'taxonomy'      => $this->taxonomy,
            'field_type'    => $this->fieldType,
            'allow_null'    => $this->allowNull ? 1 : 0,
            'add_term'      => $this->addTerm ? 1 : 0,
            'save_terms'    => $this->saveTerms ? 1 : 0,
            'load_terms'    => $this->loadTerms ? 1 : 0,
            'return_format' => $this->returnFormat,
            'multiple'      => $this->multiple ? 1 : 0,
        ]);
    }
}
