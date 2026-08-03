<?php

namespace PWT\Admin;

defined('ABSPATH') || exit;

use PWT\Core\Paths;

class Menu
{
    public function register(): void
    {
        add_action('admin_menu', [$this, 'menu']);
    }

    public function menu(): void
    {
        add_menu_page(
            __('Panna Wild Tour', 'panna-wild-tour'),
            __('Panna Wild Tour', 'panna-wild-tour'),
            'manage_options',
            'pwt-dashboard',
            [$this, 'dashboard'],
            'dashicons-palmtree',
            30
        );

        add_submenu_page(
            'pwt-dashboard',
            __('Dashboard', 'panna-wild-tour'),
            __('Dashboard', 'panna-wild-tour'),
            'manage_options',
            'pwt-dashboard',
            [$this, 'dashboard']
        );

        add_submenu_page(
            'pwt-dashboard',
            __('Settings', 'panna-wild-tour'),
            __('Settings', 'panna-wild-tour'),
            'manage_options',
            'pwt-settings',
            [$this, 'settings']
        );

        add_submenu_page(
            'pwt-dashboard',
            __('Content Forms', 'panna-wild-tour'),
            __('Content Forms', 'panna-wild-tour'),
            'manage_options',
            'pwt-content-forms',
            [$this, 'contentForms']
        );
    }

    public function dashboard(): void
    {
        include Paths::path('app/Admin/Views/dashboard.php');
    }

    public function settings(): void
    {
        include Paths::path('app/Admin/Views/settings.php');
    }

    public function contentForms(): void
    {
        include Paths::path('app/Admin/Views/content-forms.php');
    }
}