<?php

namespace PWT\Core;

defined('ABSPATH') || exit;

abstract class ServiceProvider
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register(): void
    {
    }

    public function boot(): void
    {
    }
}