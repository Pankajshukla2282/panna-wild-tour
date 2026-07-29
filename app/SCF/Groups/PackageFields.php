<?php

declare(strict_types=1);

namespace PWT\SCF\Groups;

defined('ABSPATH') || exit;

use PWT\SCF\FieldGroup;

/**
 * Package field group.
 */
final class PackageFields extends FieldGroup
{
    /**
     * Register package field group.
     */
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_package_details',

            'title' => __('Package Details', 'panna-wild-tour'),

            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_package',
            ]]],

            'fields' => [

                [
                    'key' => 'field_pwt_package_subtitle',
                    'label' => __('Subtitle', 'panna-wild-tour'),
                    'name' => 'subtitle',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_pwt_package_code',
                    'label' => __('Package Code', 'panna-wild-tour'),
                    'name' => 'package_code',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_pwt_package_duration',
                    'label' => __('Duration', 'panna-wild-tour'),
                    'name' => 'duration',
                    'type' => 'text',
                ],

                [
                    'key' => 'field_pwt_package_days',
                    'label' => __('Days', 'panna-wild-tour'),
                    'name' => 'days',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_package_nights',
                    'label' => __('Nights', 'panna-wild-tour'),
                    'name' => 'nights',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_package_regular_price',
                    'label' => __('Regular Price (INR)', 'panna-wild-tour'),
                    'name' => 'regular_price',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_package_offer_price',
                    'label' => __('Offer Price (INR)', 'panna-wild-tour'),
                    'name' => 'offer_price',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_package_child_price',
                    'label' => __('Child Price (INR)', 'panna-wild-tour'),
                    'name' => 'child_price',
                    'type' => 'number',
                ],

                [
                    'key' => 'field_pwt_package_peak_multiplier',
                    'label' => __('Peak Season Multiplier', 'panna-wild-tour'),
                    'name' => 'peak_multiplier',
                    'type' => 'number',
                    'default_value' => 1.2,
                ],

                [
                    'key' => 'field_pwt_package_shoulder_multiplier',
                    'label' => __('Shoulder Season Multiplier', 'panna-wild-tour'),
                    'name' => 'shoulder_multiplier',
                    'type' => 'number',
                    'default_value' => 1,
                ],

                [
                    'key' => 'field_pwt_package_monsoon_multiplier',
                    'label' => __('Monsoon Season Multiplier', 'panna-wild-tour'),
                    'name' => 'monsoon_multiplier',
                    'type' => 'number',
                    'default_value' => 0.85,
                ],

                [
                    'key' => 'field_pwt_package_resorts',
                    'label' => __('Related Resorts', 'panna-wild-tour'),
                    'name' => 'resorts',
                    'type' => 'relationship',
                    'post_type' => ['pwt_resort'],
                    'return_format' => 'id',
                ],

                [
                    'key' => 'field_pwt_package_cover_image',
                    'label' => __('Cover Image', 'panna-wild-tour'),
                    'name' => 'cover_image',
                    'type' => 'image',
                    'return_format' => 'array',
                ],

                [
                    'key' => 'field_pwt_package_gallery',
                    'label' => __('Gallery', 'panna-wild-tour'),
                    'name' => 'gallery',
                    'type' => 'gallery',
                    'return_format' => 'array',
                ],

                [
                    'key' => 'field_pwt_package_brochure',
                    'label' => __('Brochure', 'panna-wild-tour'),
                    'name' => 'brochure',
                    'type' => 'file',
                    'return_format' => 'array',
                ],

                [
                    'key' => 'field_pwt_package_booking_enabled',
                    'label' => __('Enable Booking', 'panna-wild-tour'),
                    'name' => 'booking_enabled',
                    'type' => 'true_false',
                ],

                [
                    'key' => 'field_pwt_package_min_person',
                    'label' => __('Minimum Persons', 'panna-wild-tour'),
                    'name' => 'minimum_person',
                    'type' => 'number',
                    'default_value' => 1,
                ],

                [
                    'key' => 'field_pwt_package_max_person',
                    'label' => __('Maximum Persons', 'panna-wild-tour'),
                    'name' => 'maximum_person',
                    'type' => 'number',
                    'default_value' => 12,
                ],

                [
                    'key' => 'field_pwt_package_inclusions',
                    'label' => __('Inclusions', 'panna-wild-tour'),
                    'name' => 'inclusions',
                    'type' => 'textarea',
                ],

                [
                    'key' => 'field_pwt_package_exclusions',
                    'label' => __('Exclusions', 'panna-wild-tour'),
                    'name' => 'exclusions',
                    'type' => 'textarea',
                ],

                [
                    'key' => 'field_pwt_package_itinerary',
                    'label' => __('Itinerary Days', 'panna-wild-tour'),
                    'name' => 'days_itinerary',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => __('Add Day', 'panna-wild-tour'),

                    'sub_fields' => [

                        [
                            'key' => 'field_pwt_package_itinerary_title',
                            'label' => __('Day Title', 'panna-wild-tour'),
                            'name' => 'title',
                            'type' => 'text',
                        ],

                        [
                            'key' => 'field_pwt_package_itinerary_description',
                            'label' => __('Description', 'panna-wild-tour'),
                            'name' => 'description',
                            'type' => 'textarea',
                        ],

                        [
                            'key' => 'field_pwt_package_itinerary_photo',
                            'label' => __('Photo', 'panna-wild-tour'),
                            'name' => 'photo',
                            'type' => 'image',
                            'return_format' => 'array',
                        ],
                    ],
                ],

            ],
        ]);
    }
}