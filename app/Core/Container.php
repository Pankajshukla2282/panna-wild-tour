<?php

namespace PWT\Core;

defined('ABSPATH') || exit;

class Container
{
    /**
     * Registered providers.
     *
     * @var array
     */
    protected array $providers = [];

    /**
     * Register provider.
     */
    public function register(string $provider): void
    {
        $this->providers[] = new $provider($this);
    }

    /**
     * Boot all providers.
     */
    public function boot(): void
    {
        foreach ($this->providers as $provider) {

            if (method_exists($provider, 'register')) {
                $provider->register();
            }

            if (method_exists($provider, 'boot')) {
                $provider->boot();
            }
        }
    }
}