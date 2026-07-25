<?php

namespace PWT\Bookings;

defined('ABSPATH') || exit;

class EmailTemplates
{
    public static function bookingAdminSubject(string $name): string
    {
        return sprintf(
            /* translators: %s: customer name */
            __('New Booking Request from %s', 'panna-wild-tour'),
            $name
        );
    }

    public static function bookingAdminBody(array $data): string
    {
        $lines = [
            __('A new booking request has been submitted.', 'panna-wild-tour'),
            '',
            __('Name', 'panna-wild-tour') . ': ' . ($data['name'] ?? ''),
            __('Phone', 'panna-wild-tour') . ': ' . ($data['phone'] ?? ''),
            __('Email', 'panna-wild-tour') . ': ' . ($data['email'] ?? ''),
            __('Travel Date', 'panna-wild-tour') . ': ' . ($data['travel_date'] ?? ''),
            __('Persons', 'panna-wild-tour') . ': ' . ($data['persons'] ?? ''),
            __('Package', 'panna-wild-tour') . ': ' . ($data['package_name'] ?? ''),
            __('Message', 'panna-wild-tour') . ': ' . ($data['message'] ?? ''),
        ];

        if (!empty($data['estimated_total'])) {
            $lines[] = __('Estimated Total', 'panna-wild-tour') . ': ' . $data['estimated_total'];
        }

        if (!empty($data['payment_link'])) {
            $lines[] = __('Payment Link', 'panna-wild-tour') . ': ' . $data['payment_link'];
        }

        return implode("\n", $lines);
    }
}
