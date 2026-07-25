<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class ReviewFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_review_details',
            'title' => 'Review Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_review',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_review_rating',
                    'label' => 'Rating (1-5)',
                    'name' => 'rating',
                    'type' => 'number',
                ],
                [
                    'key' => 'field_pwt_review_guest_city',
                    'label' => 'Guest City',
                    'name' => 'guest_city',
                    'type' => 'text',
                ],
                [
                    'key' => 'field_pwt_review_verified',
                    'label' => 'Verified Customer',
                    'name' => 'verified',
                    'type' => 'true_false',
                ],
            ],
        ]);
    }
}
