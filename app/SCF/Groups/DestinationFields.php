<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class DestinationFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_destination_details',
            'title' => 'Destination Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_destination',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_destination_subtitle',
                    'label' => 'Subtitle',
                    'name' => 'subtitle',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_destination_distance',
                    'label' => 'Distance from Panna (KM)',
                    'name' => 'distance_km',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_destination_best_time',
                    'label' => 'Best Time to Visit',
                    'name' => 'best_time',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_destination_highlights',
                    'label' => 'Highlights',
                    'name' => 'highlights',
                    'type' => 'textarea',
                ],
                [
                    'key' => 'field_pwt_destination_map_url',
                    'label' => 'Google Map URL',
                    'name' => 'map_url',
                    'type' => 'url',
                ],
                [
                    'key' => 'field_pwt_destination_gallery',
                    'label' => 'Gallery',
                    'name' => 'gallery',
                    'type' => 'gallery',
                ],
            ],
        ]);
    }
}
