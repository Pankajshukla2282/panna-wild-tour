<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class VehicleFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_vehicle_details',
            'title' => 'Vehicle Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_vehicle',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_vehicle_type',
                    'label' => 'Vehicle Type',
                    'name' => 'vehicle_type',
                    'type' => 'select',
                    'choices' => [
                        'jeep' => 'Jeep',
                        'canter' => 'Canter',
                        'tempo' => 'Tempo Traveller',
                        'car' => 'Car',
                    ],
                ],
                [
                    'key' => 'field_pwt_vehicle_capacity',
                    'label' => 'Passenger Capacity',
                    'name' => 'capacity',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_vehicle_price_day',
                    'label' => 'Price per Day (INR)',
                    'name' => 'price_per_day',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_vehicle_ac',
                    'label' => 'Air Conditioned',
                    'name' => 'is_ac',
                    'type' => 'true_false',
                ],
                [
                    'key' => 'field_pwt_vehicle_notes',
                    'label' => 'Vehicle Notes',
                    'name' => 'notes',
                    'type' => 'textarea',
                ],
            ],
        ]);
    }
}
