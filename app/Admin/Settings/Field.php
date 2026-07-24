<?php

namespace PWT\Admin\Settings;

defined('ABSPATH') || exit;

class Field
{
    public function __construct(
        protected string $id,
        protected string $label,
        protected string $type = 'text'
    ) {
    }

    public function register(
        string $page,
        string $section
    ): void {

        add_settings_field(
            $this->id,
            $this->label,
            [$this, 'render'],
            $page,
            $section
        );
    }

    public function render(): void
    {
        $options = get_option('pwt_settings', []);

        $value = $options[$this->id] ?? '';

        printf(
            '<input class="regular-text" type="%s" name="pwt_settings[%s]" value="%s">',
            esc_attr($this->type),
            esc_attr($this->id),
            esc_attr($value)
        );
    }
}