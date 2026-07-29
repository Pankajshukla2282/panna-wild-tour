<?php

declare(strict_types=1);

namespace PWT\Frontend;

defined('ABSPATH') || exit;

final class TemplateLoader
{
    public function register(): void
    {
        add_filter(
            'template_include',
            [$this, 'template'],
            99
        );
    }

    public function template(string $template): string
    {
        return apply_filters(
            'pwt/template',
            $template
        );
    }
}