<?php

declare(strict_types=1);

namespace PWT\Bookings\Repositories;

defined('ABSPATH') || exit;

final class BookingRepository
{
    public function create(array $booking)
    {
        $postId = wp_insert_post([

            'post_type' => 'pwt_booking',

            'post_status' => 'publish',

            'post_title' => sprintf(
                '%s - %s',
                $booking['name'],
                current_time('mysql')
            ),
        ]);

        if (is_wp_error($postId)) {
            return $postId;
        }

        foreach ($booking as $key => $value) {
            update_post_meta(
                $postId,
                $key,
                $value
            );
        }

        return $postId;
    }
}