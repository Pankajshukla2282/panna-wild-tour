<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class PackageFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_package_details',
            'title' => 'Package Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_package',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_package_subtitle',
                    'label' => 'Subtitle',
                    'name' => 'subtitle',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_package_code',
                    'label' => 'Package Code',
                    'name' => 'package_code',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_package_duration',
                    'label' => 'Duration Text',
                    'name' => 'duration',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_package_days',
                    'label' => 'Days',
                    'name' => 'days',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_package_nights',
                    'label' => 'Nights',
                    'name' => 'nights',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_package_regular_price',
                    'label' => 'Regular Price (INR)',
                    'name' => 'regular_price',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_package_offer_price',
                    'label' => 'Offer Price (INR)',
                    'name' => 'offer_price',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_package_child_price',
                    'label' => 'Child Price (INR)',
                    'name' => 'child_price',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_package_peak_multiplier',
                    'label' => 'Peak Season Multiplier',
                    'name' => 'peak_multiplier',
                    'type' => 'number',
                    'default_value' => 1.2,
                ],
                [
                    'key' => 'field_pwt_package_shoulder_multiplier',
                    'label' => 'Shoulder Season Multiplier',
                    'name' => 'shoulder_multiplier',
                    'type' => 'number',
                    'default_value' => 1,
                ],
                [
                    'key' => 'field_pwt_package_monsoon_multiplier',
                    'label' => 'Monsoon Season Multiplier',
                    'name' => 'monsoon_multiplier',
                    'type' => 'number',
                    'default_value' => 0.85,
                ],
                [
                    'key' => 'field_pwt_package_resorts',
                    'label' => 'Related Resorts',
                    'name' => 'resorts',
                    'type' => 'relationship',
                    'post_type' => ['pwt_resort'],
                    'return_format' => 'id',
                ],
                [
                    'key' => 'field_pwt_package_cover_image',
                    'label' => 'Cover Image',
                    'name' => 'cover_image',
                    'type' => 'image',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_pwt_package_gallery',
                    'label' => 'Gallery',
                    'name' => 'gallery',
                    'type' => 'gallery',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_pwt_package_brochure',
                    'label' => 'Brochure',
                    'name' => 'brochure',
                    'type' => 'file',
                    'return_format' => 'array',
                ],
                [
                    'key' => 'field_pwt_package_booking_enabled',
                    'label' => 'Enable Booking',
                    'name' => 'booking_enabled',
                    'type' => 'true_false',
                ],
                [
                    'key' => 'field_pwt_package_min_person',
                    'label' => 'Minimum Persons',
                    'name' => 'minimum_person',
                    'type' => 'number',
                    'default_value' => 1,
                ],
                [
                    'key' => 'field_pwt_package_max_person',
                    'label' => 'Maximum Persons',
                    'name' => 'maximum_person',
                    'type' => 'number',
                    'default_value' => 12,
                ],
                [
                    'key' => 'field_pwt_package_inclusions',
                    'label' => 'Inclusions',
                    'name' => 'inclusions',
                    'type' => 'textarea',
                ],
                [
                    'key' => 'field_pwt_package_exclusions',
                    'label' => 'Exclusions',
                    'name' => 'exclusions',
                    'type' => 'textarea',
                ],
                [
                    'key' => 'field_pwt_package_days',
                    'label' => 'Itinerary Days',
                    'name' => 'days_itinerary',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'button_label' => 'Add Day',
                    'sub_fields' => [
                        [
                            'key' => 'field_pwt_package_days_title',
                            'label' => 'Day Title',
                            'name' => 'title',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_pwt_package_days_description',
                            'label' => 'Description',
                            'name' => 'description',
                            'type' => 'textarea',
                        ],
                        [
                            'key' => 'field_pwt_package_days_photo',
                            'label' => 'Photo',
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
