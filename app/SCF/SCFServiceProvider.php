<?php

namespace PWT\SCF;

use PWT\Core\ServiceProvider;

defined('ABSPATH') || exit;

class SCFServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_action(
            'init',
            [$this,'registerGroups'],
            20
        );
    }

    public function registerGroups(): void
    {
        if (!function_exists('scf_register_field_group') && !function_exists('acf_add_local_field_group')) {
            return;
        }

        (new Groups\SafariFields())->register();

        (new Groups\PackageFields())->register();

        (new Groups\ResortFields())->register();

        (new Groups\VehicleFields())->register();

        (new Groups\DestinationFields())->register();

        (new Groups\TestimonialFields())->register();

        (new Groups\FAQFields())->register();
    }
}