<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class ResortFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_resort_details',
            'title' => 'Resort Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_resort',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_resort_type',
                    'label' => 'Resort Type',
                    'name' => 'resort_type',
                    'type' => 'select',
                    'choices' => [
                        'budget' => 'Budget',
                        'premium' => 'Premium',
                        'luxury' => 'Luxury',
                    ],
                ],
                [
                    'key' => 'field_pwt_resort_price',
                    'label' => 'Price per Night (INR)',
                    'name' => 'price_per_night',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_resort_distance_gate',
                    'label' => 'Distance from Safari Gate (KM)',
                    'name' => 'distance_from_gate',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_resort_amenities',
                    'label' => 'Amenities',
                    'name' => 'amenities',
                    'type' => 'checkbox',
                    'choices' => [
                        'pool' => 'Swimming Pool',
                        'wifi' => 'WiFi',
                        'parking' => 'Parking',
                        'restaurant' => 'Restaurant',
                        'pickup' => 'Pickup & Drop',
                    ],
                ],
                [
                    'key' => 'field_pwt_resort_contact_phone',
                    'label' => 'Contact Phone',
                    'name' => 'contact_phone',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_resort_contact_email',
                    'label' => 'Contact Email',
                    'name' => 'contact_email',
                    'type' => 'email',
                ],
            ],
        ]);
    }
}
