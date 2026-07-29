<?php

declare(strict_types=1);

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

/**
 * Safari field group.
 */
final class SafariFields extends FieldGroup
{
    /**
     * Register field group.
     */
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_safari_details',

            'title' => __('Safari Details', 'panna-wild-tour'),

            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_safari',
            ]]],

            'fields' => [

                [
                    'key' => 'field_pwt_safari_code',
                    'label' => __('Safari Code', 'panna-wild-tour'),
                    'name' => 'safari_code',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_pwt_safari_type',
                    'label' => __('Safari Type', 'panna-wild-tour'),
                    'name' => 'safari_type',
                    'type' => 'select',
                    'choices' => [
                        'jeep'    => __('Jeep Safari', 'panna-wild-tour'),
                        'canter'  => __('Canter Safari', 'panna-wild-tour'),
                        'private' => __('Private Safari', 'panna-wild-tour'),
                    ],
                ],

                [
                    'key' => 'field_pwt_safari_shift',
                    'label' => __('Shift', 'panna-wild-tour'),
                    'name' => 'shift',
                    'type' => 'select',
                    'choices' => [
                        'morning' => __('Morning', 'panna-wild-tour'),
                        'evening' => __('Evening', 'panna-wild-tour'),
                        'full_day' => __('Full Day', 'panna-wild-tour'),
                    ],
                ],

                [
                    'key' => 'field_pwt_safari_duration',
                    'label' => __('Duration', 'panna-wild-tour'),
                    'name' => 'duration',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_pwt_safari_price',
                    'label' => __('Base Price (INR)', 'panna-wild-tour'),
                    'name' => 'regular_price',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_safari_offer_price',
                    'label' => __('Offer Price (INR)', 'panna-wild-tour'),
                    'name' => 'offer_price',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_safari_meeting_point',
                    'label' => __('Meeting Point', 'panna-wild-tour'),
                    'name' => 'meeting_point',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_pwt_safari_notes',
                    'label' => __('Inclusions', 'panna-wild-tour'),
                    'name' => 'inclusions',
                    'type' => 'textarea',
                ],
            ],
        ]);
    }
}