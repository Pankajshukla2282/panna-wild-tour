<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class SafariFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_safari_details',
            'title' => 'Safari Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_safari',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_safari_code',
                    'label' => 'Safari Code',
                    'name' => 'safari_code',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_safari_type',
                    'label' => 'Safari Type',
                    'name' => 'safari_type',
                    'type' => 'select',
                    'choices' => [
                        'jeep' => 'Jeep Safari',
                        'canter' => 'Canter Safari',
                        'private' => 'Private Safari',
                    ],
                ],
                [
                    'key' => 'field_pwt_safari_shift',
                    'label' => 'Shift',
                    'name' => 'shift',
                    'type' => 'select',
                    'choices' => [
                        'morning' => 'Morning',
                        'evening' => 'Evening',
                        'full_day' => 'Full Day',
                    ],
                ],
                [
                    'key' => 'field_pwt_safari_duration',
                    'label' => 'Duration',
                    'name' => 'duration',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_safari_price',
                    'label' => 'Base Price (INR)',
                    'name' => 'regular_price',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_safari_offer_price',
                    'label' => 'Offer Price (INR)',
                    'name' => 'offer_price',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_safari_meeting_point',
                    'label' => 'Meeting Point',
                    'name' => 'meeting_point',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_safari_notes',
                    'label' => 'Inclusions',
                    'name' => 'inclusions',
                    'type' => 'textarea',
                ],
            ],
        ]);
    }
}
