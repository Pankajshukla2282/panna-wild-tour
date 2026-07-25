<?php

namespace PWT\SCF\Builder\Support;

use PWT\SCF\Builder\Group;

defined('ABSPATH') || exit;

/**
 * Renders field group configurations for debug / preview purposes.
 */
class Renderer
{
    /**
     * Register and immediately render a field group via SCF.
     *
     * @param Group $group
     */
    public function renderFieldGroup(Group $group): void
    {
        if (function_exists('scf_register_field_group')) {
            scf_register_field_group($group->build());
        }
    }

    /**
     * Return a formatted HTML preview of the group config (admin-only).
     *
     * @param  Group  $group
     * @return string  Preformatted HTML string.
     */
    public function preview(Group $group): string
    {
        $config = $group->build();
        $encoded = (string) wp_json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return '<pre>' . esc_html($encoded) . '</pre>';
    }
}
