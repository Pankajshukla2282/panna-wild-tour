<?php

declare(strict_types=1);

namespace PWT\SCF\Groups;

defined('ABSPATH') || exit;

use PWT\SCF\FieldGroup;

/**
 * Resort field group.
 */
final class ResortFields extends FieldGroup
{
    /**
     * Register resort field group.
     */
    public function register(): void
    {
        $this->addGroup([
            'key'   => 'group_pwt_resort_details',

            'title' => __('Resort Details', 'panna-wild-tour'),

            'location' => [[[
                'param'    => 'post_type',
                'operator' => '=',
                'value'    => 'pwt_resort',
            ]]],

            'fields' => [

                [
                    'key'     => 'field_pwt_resort_type',
                    'label'   => __('Resort Type', 'panna-wild-tour'),
                    'name'    => 'resort_type',
                    'type'    => 'select',
                    'choices' => [
                        'budget'  => __('Budget', 'panna-wild-tour'),
                        'premium' => __('Premium', 'panna-wild-tour'),
                        'luxury'  => __('Luxury', 'panna-wild-tour'),
                    ],
                ],

                [
                    'key'   => 'field_pwt_resort_price',
                    'label' => __('Price per Night (INR)', 'panna-wild-tour'),
                    'name'  => 'price_per_night',
                    'type'  => 'number',
                ],

                [
                    'key'   => 'field_pwt_resort_distance_gate',
                    'label' => __('Distance from Safari Gate (KM)', 'panna-wild-tour'),
                    'name'  => 'distance_from_gate',
                    'type'  => 'number',
                ],

                [
                    'key'     => 'field_pwt_resort_amenities',
                    'label'   => __('Amenities', 'panna-wild-tour'),
                    'name'    => 'amenities',
                    'type'    => 'checkbox',
                    'choices' => [
                        'pool'       => __('Swimming Pool', 'panna-wild-tour'),
                        'wifi'       => __('WiFi', 'panna-wild-tour'),
                        'parking'    => __('Parking', 'panna-wild-tour'),
                        'restaurant' => __('Restaurant', 'panna-wild-tour'),
                        'pickup'     => __('Pickup & Drop', 'panna-wild-tour'),
                    ],
                ],

                [
                    'key'   => 'field_pwt_resort_contact_phone',
                    'label' => __('Contact Phone', 'panna-wild-tour'),
                    'name'  => 'contact_phone',
                    'type'  => 'text',
                ],

                [
                    'key'   => 'field_pwt_resort_contact_email',
                    'label' => __('Contact Email', 'panna-wild-tour'),
                    'name'  => 'contact_email',
                    'type'  => 'email',
                ],

            ],
        ]);
    }
}