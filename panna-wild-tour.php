<?php
/**
 * Plugin Name: Panna Wild Tour
 * Description: This is a WordPress plugins for Wild Tours and travels agency.
 * Version: 1.0.0
 * Author: Panna Wild Tour
 * Author URI: https://www.pannawildtour.com
 */

defined('ABSPATH') || exit;

define('PWT_VERSION', '1.0.0');
define('PWT_PLUGIN_FILE', __FILE__);
define('PWT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PWT_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once PWT_PLUGIN_PATH . 'app/Core/Autoloader.php';

PWT\Core\Autoloader::register();

$app = new PWT\Core\Application();

$app->boot();



register_activation_hook(
    __FILE__,
    ['PWT\Core\Activator', 'activate']
);

register_deactivation_hook(
    __FILE__,
    ['PWT\Core\Deactivator', 'deactivate']
);

