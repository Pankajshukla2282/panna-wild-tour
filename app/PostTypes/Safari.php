<?php

namespace PWT\PostTypes;

defined('ABSPATH') || exit;

class Safari extends PostType
{
    protected string $postType = 'pwt_safari';

    protected string $singular = 'Safari';

    protected string $plural = 'Safaris';

    protected function menuIcon(): string
    {
        return 'dashicons-camera';
    }
}