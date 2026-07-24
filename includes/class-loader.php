<?php

defined('ABSPATH') || exit;

class PWT_Loader
{
    public function run()
    {
        add_action('plugins_loaded', [$this, 'load_textdomain']);
    }

    public function load_textdomain()
    {
        load_plugin_textdomain(
            'panna-wild-tour',
            false,
            dirname(plugin_basename(PWT_PLUGIN_FILE)) . '/languages'
        );
    }
}