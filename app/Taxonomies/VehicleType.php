<?php

namespace PWT\Taxonomies;

class VehicleType extends Taxonomy
{
    protected string $taxonomy = 'pwt_vehicle_type';

    protected string $singular = 'Vehicle Type';

    protected string $plural = 'Vehicle Types';

    protected array $postTypes = [
        'pwt_vehicle',
        'pwt_safari'
    ];
}