<?php

declare(strict_types=1);

namespace PWT\Bookings\Validators;

defined('ABSPATH') || exit;

final class BookingValidator
{
    public function validate(array $data): array
    {
        $clean = [

            'name' => sanitize_text_field($data['name'] ?? ''),

            'email' => sanitize_email($data['email'] ?? ''),

            'phone' => sanitize_text_field($data['phone'] ?? ''),

            'travel_date' => sanitize_text_field($data['travel_date'] ?? ''),

            'persons' => absint($data['persons'] ?? 1),

            'message' => sanitize_textarea_field($data['message'] ?? ''),
        ];

        if ($clean['name'] === '') {

            return [
                'success' => false,
                'message' => __('Please enter your name.', 'panna-wild-tour'),
            ];
        }

        if (!is_email($clean['email'])) {

            return [
                'success' => false,
                'message' => __('Please enter a valid email address.', 'panna-wild-tour'),
            ];
        }

        if ($clean['phone'] === '') {

            return [
                'success' => false,
                'message' => __('Phone number is required.', 'panna-wild-tour'),
            ];
        }

        return [
            'success' => true,
            'data' => $clean,
        ];
    }
}