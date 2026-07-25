<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** WordPress user selector field. */
class User extends Field
{
    protected array $role = [];
    protected bool $allowNull = false;
    protected bool $multiple = false;
    protected string $returnFormat = 'array';

    /** Filter by user roles. */
    public function role(array $roles): static
    {
        $this->role = $roles;
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

    /** Return format: 'array' | 'object' | 'id' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'user',
            'role'          => $this->role,
            'allow_null'    => $this->allowNull ? 1 : 0,
            'multiple'      => $this->multiple ? 1 : 0,
            'return_format' => $this->returnFormat,
        ]);
    }
}
