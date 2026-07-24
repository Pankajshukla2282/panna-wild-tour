<?php

namespace PWT\Admin\Settings;

defined('ABSPATH') || exit;

class Sanitizer
{
    public static function sanitize(array $input): array
    {
        $output = [];

        foreach ($input as $key => $value) {

            switch ($key) {

                case 'email':

                    $output[$key] =
                        sanitize_email($value);

                    break;

                case 'phone':

                    $output[$key] =
                        preg_replace(
                            '/[^0-9+]/',
                            '',
                            $value
                        );

                    break;

                case 'website':

                    $output[$key] =
                        esc_url_raw($value);

                    break;

                default:

                    $output[$key] =
                        sanitize_text_field($value);

            }
        }

        return $output;
    }
}