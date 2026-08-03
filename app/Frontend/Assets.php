<?php

declare(strict_types=1);

namespace PWT\Frontend;

defined('ABSPATH') || exit;

use PWT\Core\Paths;

final class Assets
{
    public function register(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue(): void
    {
        wp_enqueue_style(
            'pwt-plugin',
            Paths::uri('assets/css/frontend.css'),
            [],
            PWT_VERSION
        );

        wp_enqueue_script(
            'pwt-plugin',
            Paths::uri('assets/js/frontend.js'),
            ['jquery'],
            PWT_VERSION,
            true
        );

        wp_localize_script(
            'pwt-plugin',
            'pwtData',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('pwt_nonce'),
            ]
        );
    }
}