<?php

defined('ABSPATH') || exit;

$page = new Page(
    'pwt_settings_group',
    'pwt_settings',
    'pwt-settings'
);

$general = new Section(
    'general',
    'General Settings'
);

$general->addField(
    new Field(
        'company_name',
        'Company Name'
    )
);

$general->addField(
    new Field(
        'email',
        'Email',
        'email'
    )
);

$general->addField(
    new Field(
        'phone',
        'Phone'
    )
);

$page->addSection($general);

$manager->register($page);