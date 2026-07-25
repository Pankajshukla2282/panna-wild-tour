<?php

namespace PWT\Frontend;

defined('ABSPATH') || exit;

class TemplateLoader
{
    public function register(): void
    {
        add_filter('template_include', [$this, 'template']);
    }

    public function template(string $template): string
    {
        if (is_post_type_archive(['pwt_package', 'pwt_safari', 'pwt_destination']) || is_tax(['pwt_package_category', 'pwt_safari_zone', 'pwt_season', 'pwt_destination_category'])) {
            $candidate = PWT_PLUGIN_PATH . 'public/templates/archive-listing.php';

            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        if (is_singular('pwt_package')) {
            $candidate = PWT_PLUGIN_PATH . 'public/templates/single-package.php';

            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        if (is_singular('pwt_safari')) {
            $candidate = PWT_PLUGIN_PATH . 'public/templates/single-safari.php';

            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        return $template;
    }
}
