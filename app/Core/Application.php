<?php

declare(strict_types=1);

namespace PWT\Core;

defined('ABSPATH') || exit;

use PWT\Admin\AdminServiceProvider;
use PWT\Analytics\AnalyticsServiceProvider;
use PWT\Api\ApiServiceProvider;
use PWT\Frontend\FrontendServiceProvider;
use PWT\Integrations\IntegrationServiceProvider;
use PWT\PostTypes\PostTypeServiceProvider;
use PWT\SCF\SCFServiceProvider;
use PWT\Taxonomies\TaxonomyServiceProvider;
use PWT\Widgets\WidgetServiceProvider;

/**
 * Plugin application.
 */
final class Application
{
    /**
     * @var array<class-string<ServiceProvider>>
     */
    private const PROVIDERS = [
        PostTypeServiceProvider::class,
        TaxonomyServiceProvider::class,
        SCFServiceProvider::class,
        FrontendServiceProvider::class,
        ApiServiceProvider::class,
        WidgetServiceProvider::class,
        AnalyticsServiceProvider::class,
        AdminServiceProvider::class,
        IntegrationServiceProvider::class,
    ];

    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function boot(): void
    {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init(): void
    {
        $this->loadTextDomain();

        foreach (self::PROVIDERS as $provider) {
            $this->container->register($provider);
        }

        $this->container->boot();
    }

    private function loadTextDomain(): void
    {
        load_plugin_textdomain(
            'panna-wild-tour',
            false,
            dirname(plugin_basename(PWT_PLUGIN_FILE)) . '/languages'
        );
    }
}