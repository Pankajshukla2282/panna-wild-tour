<?php

namespace PWT\Core;

defined('ABSPATH') || exit;

use PWT\Admin\AdminServiceProvider;
use PWT\API\ApiServiceProvider;
use PWT\Analytics\AnalyticsServiceProvider;
use PWT\Frontend\FrontendServiceProvider;
use PWT\PostTypes\PostTypeServiceProvider;
use PWT\Taxonomies\TaxonomyServiceProvider;
use PWT\SCF\SCFServiceProvider;
use PWT\Widgets\WidgetServiceProvider;

class Application
{
    protected Container $container;

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
        load_plugin_textdomain(
            'panna-wild-tour',
            false,
            dirname(plugin_basename(PWT_PLUGIN_FILE)) . '/languages'
        );

        $this->registerProviders();

        $this->container->boot();
    }

    protected function registerProviders(): void
    {
        $this->container->register(AdminServiceProvider::class);

        $this->container->register(PostTypeServiceProvider::class);

        $this->container->register(TaxonomyServiceProvider::class);

        $this->container->register(SCFServiceProvider::class);

        $this->container->register(FrontendServiceProvider::class);

        $this->container->register(ApiServiceProvider::class);

        $this->container->register(WidgetServiceProvider::class);

        $this->container->register(AnalyticsServiceProvider::class);
    }
}