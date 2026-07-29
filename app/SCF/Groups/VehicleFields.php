<?php

declare(strict_types=1);

namespace PWT\SCF\Groups;

defined('ABSPATH') || exit;

use PWT\SCF\FieldGroup;

/**
 * Vehicle field group.
 */
final class VehicleFields extends FieldGroup
{
    /**
     * Register vehicle field group.
     */
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_vehicle_details',

            'title' => __('Vehicle Details', 'panna-wild-tour'),

            'location' => [[[
                'param'    => 'post_type',
                'operator' => '=',
                'value'    => 'pwt_vehicle',
            ]]],

            'fields' => [

                [
                    'key'     => 'field_pwt_vehicle_type',
                    'label'   => __('Vehicle Type', 'panna-wild-tour'),
                    'name'    => 'vehicle_type',
                    'type'    => 'select',

                    'choices' => [
                        'jeep'    => __('Jeep', 'panna-wild-tour'),
                        'canter'  => __('Canter', 'panna-wild-tour'),
                        'tempo'   => __('Tempo Traveller', 'panna-wild-tour'),
                        'car'     => __('Car', 'panna-wild-tour'),
                    ],
                ],

                [
                    'key'   => 'field_pwt_vehicle_capacity',
                    'label' => __('Passenger Capacity', 'panna-wild-tour'),
                    'name'  => 'capacity',
                    'type'  => 'number',
                ],

                [
                    'key'   => 'field_pwt_vehicle_price_day',
                    'label' => __('Price per Day (INR)', 'panna-wild-tour'),
                    'name'  => 'price_per_day',
                    'type'  => 'number',
                ],

                [
                    'key'   => 'field_pwt_vehicle_ac',
                    'label' => __('Air Conditioned', 'panna-wild-tour'),
                    'name'  => 'is_ac',
                    'type'  => 'true_false',
                ],

                [
                    'key'   => 'field_pwt_vehicle_notes',
                    'label' => __('Vehicle Notes', 'panna-wild-tour'),
                    'name'  => 'notes',
                    'type'  => 'textarea',
                ],

            ],
        ]);
    }
}