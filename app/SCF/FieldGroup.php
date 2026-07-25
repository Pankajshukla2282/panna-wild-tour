<?php

namespace PWT\SCF;

defined('ABSPATH') || exit;

abstract class FieldGroup
{
    abstract public function register(): void;

    protected function addGroup(array $group): void
    {
        if (function_exists('scf_register_field_group')) {
            scf_register_field_group($group);
            return;
        }

        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group($group);
        }
    }
}