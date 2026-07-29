<?php

declare(strict_types=1);

namespace PWT\Bookings\Controllers;

defined('ABSPATH') || exit;

use PWT\Bookings\Services\BookingService;

/**
 * Handles booking requests.
 */
final class BookingController
{
    public function __construct(
        private readonly BookingService $bookingService
    ) {
    }

    /**
     * Register AJAX hooks.
     */
    public function register(): void
    {
        add_action('wp_ajax_pwt_booking', [$this, 'handle']);
        add_action('wp_ajax_nopriv_pwt_booking', [$this, 'handle']);
    }

    /**
     * Process booking.
     */
    public function handle(): void
    {
        check_ajax_referer('pwt_booking', 'nonce');

        $result = $this->bookingService->create($_POST);

        if ($result['success']) {
            wp_send_json_success($result);
        }

        wp_send_json_error($result, 400);
    }
}