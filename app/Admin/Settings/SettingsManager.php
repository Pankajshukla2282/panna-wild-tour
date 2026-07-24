<?php

namespace PWT\Admin\Settings;

defined('ABSPATH') || exit;

class SettingsManager
{
    private array $pages = [];

    public function register(Page $page): void
    {
        $this->pages[] = $page;
    }

    public function boot(): void
    {
        add_action('admin_init', [$this, 'registerPages']);
    }

    public function registerPages(): void
    {
        foreach ($this->pages as $page) {
            $page->register();
        }
    }
}