<?php
namespace PWT\Core;

defined('ABSPATH') || exit;

class Activator
{
    public static function activate(): void
    {
        self::seedTaxonomies();

        flush_rewrite_rules();
    }

    private static function seedTaxonomies(): void
    {
        $zones = [
            'Madla',
            'Hinauta',
            'Akola',
            'Panna Buffer'
        ];

        foreach ($zones as $zone) {

            if (!term_exists($zone, 'pwt_safari_zone')) {

                wp_insert_term(
                    $zone,
                    'pwt_safari_zone'
                );

            }

        }

        $seasons = [
            'Summer',
            'Monsoon',
            'Winter'
        ];

        foreach ($seasons as $season) {

            if (!term_exists($season, 'pwt_season')) {

                wp_insert_term(
                    $season,
                    'pwt_season'
                );

            }

        }
    }
}