<?php

declare(strict_types=1);

namespace PWT\Frontend;

defined('ABSPATH') || exit;

use PWT\Core\ServiceProvider;

final class FrontendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Reserved for future bindings.
    }

    public function boot(): void
    {
        $this->make(Assets::class)->register();
        $this->make(TemplateLoader::class)->register();
        $this->make(Search::class)->register();
        $this->make(Breadcrumbs::class)->register();
    }
}