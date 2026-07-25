<?php

namespace PWT\Widgets;

defined('ABSPATH') || exit;

class PackageFilterWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'pwt_package_filter_widget',
            __('PWT Package Filters', 'panna-wild-tour'),
            ['description' => __('Quick package category and season filters.', 'panna-wild-tour')]
        );
    }

    public function widget($args, $instance): void
    {
        $categories = get_terms(['taxonomy' => 'pwt_package_category', 'hide_empty' => true]);
        $seasons = get_terms(['taxonomy' => 'pwt_season', 'hide_empty' => true]);

        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title'] . esc_html__('Find Packages', 'panna-wild-tour') . $args['after_title']);

        echo '<form method="get" action="' . esc_url(get_post_type_archive_link('pwt_package')) . '">';
        echo '<p><select name="package_category"><option value="">' . esc_html__('All Categories', 'panna-wild-tour') . '</option>';

        foreach ($categories as $category) {
            echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
        }

        echo '</select></p>';
        echo '<p><select name="season"><option value="">' . esc_html__('All Seasons', 'panna-wild-tour') . '</option>';

        foreach ($seasons as $season) {
            echo '<option value="' . esc_attr($season->slug) . '">' . esc_html($season->name) . '</option>';
        }

        echo '</select></p>';
        echo '<p><button type="submit">' . esc_html__('Filter', 'panna-wild-tour') . '</button></p>';
        echo '</form>';

        echo wp_kses_post($args['after_widget']);
    }
}
