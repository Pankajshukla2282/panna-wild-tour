<?php

defined('ABSPATH') || exit;

class PWT_Activator
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}