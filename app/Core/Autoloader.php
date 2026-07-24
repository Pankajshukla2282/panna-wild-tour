<?php
namespace PWT\Core;

defined('ABSPATH') || exit;

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([self::class, 'autoload']);
    }

    private static function autoload(string $class): void
    {
        $prefix = 'PWT\\';

        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relative = substr($class, strlen($prefix));

        $relative = str_replace('\\', DIRECTORY_SEPARATOR, $relative);

        $file = PWT_PLUGIN_PATH . 'app/' . $relative . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}