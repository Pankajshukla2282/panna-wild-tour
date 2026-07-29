<?php

declare(strict_types=1);

namespace PWT\Bookings;

defined('ABSPATH') || exit;

/**
 * Booking email templates.
 */
final class EmailTemplates
{
    /**
     * Admin notification subject.
     */
    public static function bookingAdminSubject(string $name): string
    {
        return (string) apply_filters(
            'pwt/booking/admin_subject',
            sprintf(
                /* translators: %s: customer name */
                __('New Booking Request from %s', 'panna-wild-tour'),
                $name
            ),
            $name
        );
    }

    /**
     * Admin notification body.
     */
    public static function bookingAdminBody(array $data): string
    {
        $lines = [
            __('A new booking request has been submitted.', 'panna-wild-tour'),
            '',
            self::line(__('Name', 'panna-wild-tour'), $data['name'] ?? ''),
            self::line(__('Phone', 'panna-wild-tour'), $data['phone'] ?? ''),
            self::line(__('Email', 'panna-wild-tour'), $data['email'] ?? ''),
            self::line(__('Travel Date', 'panna-wild-tour'), $data['travel_date'] ?? ''),
            self::line(__('Persons', 'panna-wild-tour'), $data['persons'] ?? ''),
            self::line(__('Package', 'panna-wild-tour'), $data['package_name'] ?? ''),
            self::line(__('Message', 'panna-wild-tour'), $data['message'] ?? ''),
        ];

        if (!empty($data['estimated_total'])) {
            $lines[] = self::line(
                __('Estimated Total', 'panna-wild-tour'),
                (string) $data['estimated_total']
            );
        }

        if (!empty($data['payment_link'])) {
            $lines[] = self::line(
                __('Payment Link', 'panna-wild-tour'),
                (string) $data['payment_link']
            );
        }

        $body = implode(PHP_EOL, $lines);

        return (string) apply_filters(
            'pwt/booking/admin_body',
            $body,
            $data
        );
    }

    /**
     * Format a label/value pair.
     */
    private static function line(string $label, string $value): string
    {
        return sprintf('%s: %s', $label, $value);
    }
}