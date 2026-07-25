<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class TestimonialFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_testimonial_details',
            'title' => 'Testimonial Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_testimonial',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_testimonial_guest_name',
                    'label' => 'Guest Name',
                    'name' => 'guest_name',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_testimonial_guest_city',
                    'label' => 'Guest City',
                    'name' => 'guest_city',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_testimonial_rating',
                    'label' => 'Rating (1-5)',
                    'name' => 'rating',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_testimonial_month',
                    'label' => 'Travel Month',
                    'name' => 'travel_month',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_testimonial_featured',
                    'label' => 'Featured on Homepage',
                    'name' => 'featured',
                    'type' => 'true_false',
                ],
            ],
        ]);
    }
}
