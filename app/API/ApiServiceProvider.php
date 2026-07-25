<?php

namespace PWT\API;

use PWT\Core\ServiceProvider;

defined('ABSPATH') || exit;

class ApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        (new RestApi())->register();
    }
}
