<?php

namespace PWT\Frontend;

use PWT\Core\ServiceProvider;

defined('ABSPATH') || exit;

class FrontendServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        require_once PWT_PLUGIN_PATH . 'bookings/booking-manager.php';
        require_once PWT_PLUGIN_PATH . 'bookings/ajax-booking.php';
        require_once PWT_PLUGIN_PATH . 'bookings/booking-form.php';

        (new \PWT\Bookings\BookingManager())->register();
        (new \PWT\Bookings\AjaxBooking())->register();
        (new \PWT\Payments\PaymentManager())->register();

        if (!is_admin()) {
            (new Assets())->register();
            (new Shortcodes())->register();
            (new TemplateLoader())->register();
            (new Seo())->register();
            (new ArchiveFilters())->register();
        }
    }
}
