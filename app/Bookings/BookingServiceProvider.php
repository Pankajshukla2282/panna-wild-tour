<?php

declare(strict_types=1);

namespace PWT\Bookings;

defined('ABSPATH') || exit;

use PWT\Core\ServiceProvider;
use PWT\Bookings\Controllers\BookingController;

/**
 * Registers booking services.
 */
final class BookingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Reserved for future container bindings.
    }

    /**
     * Boot booking module.
     */
    public function boot(): void
    {
        $controller = $this->make(BookingController::class);

        $controller->register();
    }
}