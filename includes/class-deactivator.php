<?php

defined('ABSPATH') || exit;

class PWT_Deactivator
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}