<?php

namespace PWT\Frontend;

defined('ABSPATH') || exit;

class Assets
{
    public function register(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue(): void
    {
        wp_enqueue_style(
            'pwt-frontend',
            PWT_PLUGIN_URL . 'assets/css/frontend.css',
            [],
            PWT_VERSION
        );

        wp_enqueue_script(
            'pwt-frontend',
            PWT_PLUGIN_URL . 'assets/js/frontend.js',
            [],
            PWT_VERSION,
            true
        );

        wp_localize_script(
            'pwt-frontend',
            'pwtFrontend',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('pwt_booking_nonce'),
                'messages' => [
                    'submitting' => __('Submitting your request...', 'panna-wild-tour'),
                    'success' => __('Booking request submitted successfully.', 'panna-wild-tour'),
                    'error' => __('Unable to submit right now. Please try again.', 'panna-wild-tour')
                ]
            ]
        );
    }
}
