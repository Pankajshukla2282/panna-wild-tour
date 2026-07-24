<?php

namespace PWT\Taxonomies;

class DestinationCategory extends Taxonomy
{
    protected string $taxonomy = 'pwt_destination_category';

    protected string $singular = 'Destination Category';

    protected string $plural = 'Destination Categories';

    protected array $postTypes = [
        'pwt_destination'
    ];
}