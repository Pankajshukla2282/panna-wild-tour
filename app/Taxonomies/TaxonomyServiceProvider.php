<?php

namespace PWT\Taxonomies;

use PWT\Core\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $taxonomies = [

            new SafariZone(),

            new PackageCategory(),

            new VehicleType(),

            new DestinationCategory(),

            new Season(),

            new Activity()

        ];

        foreach ($taxonomies as $taxonomy) {

            $taxonomy->register();

        }
    }
}