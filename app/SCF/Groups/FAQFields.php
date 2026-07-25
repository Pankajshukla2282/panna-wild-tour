<?php

namespace PWT\SCF\Groups;

use PWT\SCF\FieldGroup;

defined('ABSPATH') || exit;

class FAQFields extends FieldGroup
{
    public function register(): void
    {
        $this->addGroup([
            'key' => 'group_pwt_faq_details',
            'title' => 'FAQ Details',
            'location' => [[[
                'param' => 'post_type',
                'operator' => '=',
                'value' => 'pwt_faq',
            ]]],
            'fields' => [
                [
                    'key' => 'field_pwt_faq_category',
                    'label' => 'FAQ Category',
                    'name' => 'faq_category',
                    'type' => 'select',
                    'choices' => [
                        'booking' => 'Booking',
                        'safari' => 'Safari Rules',
                        'stay' => 'Accommodation',
                        'travel' => 'Travel Information',
                    ],
                ],
                [
                    'key' => 'field_pwt_faq_priority',
                    'label' => 'Display Priority',
                    'name' => 'priority',
                    'type' => 'number',
                ],
            ],
        ]);
    }
}
