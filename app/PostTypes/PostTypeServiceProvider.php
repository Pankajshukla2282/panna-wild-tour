<?php

namespace PWT\PostTypes;

use PWT\Core\ServiceProvider;

class PostTypeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $types = [

            new Safari(),

            new Package(),

            new Resort(),

            new Vehicle(),

            new Destination(),

            new Testimonial(),

            new FAQ(),

            new Gallery()

        ];

        foreach ($types as $type) {

            $type->register();

        }
    }
}