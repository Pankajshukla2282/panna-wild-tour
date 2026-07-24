<?php

namespace PWT\Admin\Settings;

defined('ABSPATH') || exit;

class Tabs
{
    public static function render(array $tabs): void
    {
        echo '<nav class="nav-tab-wrapper">';

        foreach ($tabs as $slug => $title) {

            printf(
                '<a href="?page=pwt-settings&tab=%s" class="nav-tab">%s</a>',
                esc_attr($slug),
                esc_html($title)
            );

        }

        echo '</nav>';
    }
}