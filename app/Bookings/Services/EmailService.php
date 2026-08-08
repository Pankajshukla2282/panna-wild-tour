<?php

declare(strict_types=1);

namespace PWT\Bookings\Services;

defined('ABSPATH') || exit;

use PWT\Bookings\EmailTemplates;

final class EmailService
{
    public function sendAdminNotification(
        int $bookingId,
        array $booking
    ): void {

        wp_mail(

            get_option('admin_email'),

            EmailTemplates::bookingAdminSubject($booking['name']),

            EmailTemplates::bookingAdminBody($booking)
        );
    }

    public function sendCustomerConfirmation(
        int $bookingId,
        array $booking
    ): void {

        if (empty($booking['email'])) {
            return;
        }

        wp_mail(

            $booking['email'],

            __('Booking Confirmation', 'wildtours-plugin'),

            sprintf(
                __('Thank you %s. Your booking request has been received.', 'wildtours-plugin'),
                $booking['name']
            )
        );
    }
}