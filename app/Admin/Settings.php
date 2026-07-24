<?php

namespace PWT\Admin;

defined('ABSPATH') || exit;

class Settings
{
    public function register(): void
    {
        add_action(
            'admin_init',
            [$this, 'settings']
        );
    }

    public function settings(): void
    {
        register_setting(
            'pwt_settings_group',
            'pwt_settings'
        );

        add_settings_section(
            'pwt_general',
            __('General Settings', 'panna-wild-tour'),
            '__return_false',
            'pwt-settings'
        );

        add_settings_field(
            'company_name',
            __('Company Name', 'panna-wild-tour'),
            [$this, 'company'],
            'pwt-settings',
            'pwt_general'
        );
    }

    public function company(): void
    {
        $options = get_option('pwt_settings');

        ?>
        <input
            type="text"
            class="regular-text"
            name="pwt_settings[company_name]"
            value="<?php echo esc_attr($options['company_name'] ?? ''); ?>">
        <?php
    }
}