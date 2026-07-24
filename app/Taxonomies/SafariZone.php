<?php

namespace PWT\Taxonomies;

class SafariZone extends Taxonomy
{
    protected string $taxonomy = 'pwt_safari_zone';

    protected string $singular = 'Safari Zone';

    protected string $plural = 'Safari Zones';

    protected array $postTypes = [
        'pwt_safari'
    ];
}