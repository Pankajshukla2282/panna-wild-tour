<?php

namespace PWT\Taxonomies;

class Season extends Taxonomy
{
    protected string $taxonomy = 'pwt_season';

    protected string $singular = 'Season';

    protected string $plural = 'Seasons';

    protected array $postTypes = [
        'pwt_package',
        'pwt_safari'
    ];
}