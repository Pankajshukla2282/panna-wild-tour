<?php

namespace PWT\Taxonomies;

class Activity extends Taxonomy
{
    protected string $taxonomy = 'pwt_activity';

    protected string $singular = 'Activity';

    protected string $plural = 'Activities';

    protected array $postTypes = [
        'pwt_package',
        'pwt_destination'
    ];
}